<?php
	require_once("config.php");

	// Get rootpath
	$path = $mcFileManagerConfig['filesystem.path'];
	$path_exists = realpath($path);

	$path_canread = ($path_exists == "") ? false : canRead($path_exists);
	$path_canwrite = ($path_exists == "") ? false : canWrite($path_exists);

	$rootpath = $mcFileManagerConfig['filesystem.rootpath'];
	$rootpath_exists = realpath($rootpath);

	$rootpath_canread = ($rootpath_exists == "") ? false : canRead($rootpath_exists);
	$rootpath_canwrite = ($rootpath_exists == "") ? false : canWrite($rootpath_exists);

	$wwwroot = $mcFileManagerConfig['preview.wwwroot'];
	$wwwroot_exists = getWWWRoot($config);
	
	$authenticator = $mcFileManagerConfig['authenticator'];
	$authenticator_exists = class_exists($authenticator);


	/**
	 * Returns the wwwroot or null string if it was impossible to get.
	 *
	 * @return String wwwroot or null string if it was impossible to get.
	 */
	function getWWWRoot($config) {
		if (isset($config['preview.wwwroot']) && $config['preview.wwwroot'])
			return realpath($config['preview.wwwroot']);
		
		// Check document root
		if (isset($_SERVER['DOCUMENT_ROOT'])) {
			if (ini_get("magic_quotes_gpc"))
				return stripslashes($_SERVER['DOCUMENT_ROOT']);
			else
				return $_SERVER['DOCUMENT_ROOT'];
		}

		// Try script file
		$path = str_replace(toUnixPath($_SERVER["SCRIPT_NAME"]), "", toUnixPath($_SERVER["SCRIPT_FILENAME"]));
		if (is_dir($path))
			return toOSPath($path);

		return null;
	}


	/**
	 * Converts a Unix path to OS specific path.
	 *
	 * @param String $path Unix path to convert.
	 */
	function toOSPath($path) {
		return str_replace("/", DIRECTORY_SEPARATOR, $path);
	}

	/**
	 * Converts a OS specific path to Unix path.
	 *
	 * @param String $path OS path to convert to Unix style.
	 */
	function toUnixPath($path) {
		return str_replace(DIRECTORY_SEPARATOR, "/", $path);
	}

	function checkBool($str) {
		if ($str === true)
			return true;

		if ($str === false)
			return false;

		$str = strtolower($str);

		if ($str == "true")
			return true;

		return false;
	}

	/**
	 * Check for the GD functions that are beeing used.
	 * @return Bool true or false depending on success or not.
	 */
	function gdCheck() {
		// just make a quick check, we dont need to loop if we can't find GD at all.
		if (!function_exists("gd_info"))
			return false;

		$gdUsedFunctions = array();
		$gdUsedFunctions[] = "ImagecreateFromJpeg";
		$gdUsedFunctions[] = "ImagecreateFromPng";
		$gdUsedFunctions[] = "ImagecreateFromGif";
		$gdUsedFunctions[] = "ImageJpeg";
		$gdUsedFunctions[] = "ImagePng";
		$gdUsedFunctions[] = "ImageGif";
		$gdUsedFunctions[] = "ImageCopyResized";
		$gdUsedFunctions[] = "ImageCreateTrueColor";
		$gdUsedFunctions[] = "ImageSX";
		$gdUsedFunctions[] = "ImageSY";

		foreach($gdUsedFunctions as $function) {
			if (!function_exists($function))
				return false;
		}

		return true;
	}

	/**
	 * Returns true if the files is readable.
	 *
	 * @return boolean true if the files is readable.
	 */
	function canRead($path) {
		return is_readable(toOSPath($path));
	}

	/**
	 * Returns true if the files is writable.
	 *
	 * @return boolean true if the files is writable.
	 */
	function canWrite($path) {
		// Is windows
		if (DIRECTORY_SEPARATOR == "\\") {
			$path = toOSPath($path);

			if (is_file($path)) {
				$fp = @fopen($path,'ab');

				if ($fp) {
					fclose($fp);
					return true;
				}
			} else if (is_dir($path)) {
				$tmpnam = time().md5(uniqid('iswritable'));
				if (@touch($path . '\\' . $tmpnam)) {
					unlink($path . '\\' . $tmpnam);
					return true;
				}
			}

			return false;
		}

		// Other OS:es
		return is_writeable(toOSPath($path));
	}

	function getPHPInfo($part = "") {
		ob_start();
		phpinfo($part);	
		$contents = ob_get_contents();

		// remove body etc
		$contents = str_replace("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">", "", $contents);

		$contents = str_replace("<html><head>", "", $contents);
		$contents = str_replace("<title>phpinfo()</title></head>", "", $contents);
		$contents = str_replace("body {background-color: #ffffff; color: #000000;}", "", $contents);
		$contents = str_replace("a:link {color: #000099; text-decoration: none; background-color: #ffffff;}", "", $contents);
		$contents = str_replace("<body><div class=\"center\">", "", $contents);
		$contents = str_replace("</div></body></html>", "", $contents);

		ob_end_clean();
		return $contents;
	}

	$info_general = getPHPInfo(1);
	$info_configuration = getPHPInfo(4);
	$info_modules = getPHPInfo(8);
	$info_environment = getPHPInfo(16);
	$info_variables = getPHPInfo(32);
	$info_all = getPHPInfo(-1);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Status Check</title>
<style>

	body { background-color: #F0F0EE; margin: 10px; font-family: Verdana, Arial; font-size: 12px; }
	td { font-family: Verdana, Arial; font-size: 12px; }
	table { border-collapse: collapse; }
	legend { font-size: 14px; }
	.tdtitle { font-weight: bold; }
	.note { font-size: 10px; }
	.phpinfo { display: none; }
	a { background-color: #F0F0EE; }
</style>
<script language="Javascript">

	function elementToggle(element_id) {

		var elm = document.getElementById(element_id);
		if (elm.style.display == "block")
			elm.style.display = "none";
		else {
			elementHide();
			elm.style.display = "block";
		}
	}

	function elementHide() {
		elm = document.getElementById("phpinfoGeneral");
		elm.style.display = "none";

		elm = document.getElementById("phpinfoConfiguration");
		elm.style.display = "none";

		elm = document.getElementById("phpinfoModules");
		elm.style.display = "none";

		elm = document.getElementById("phpinfoEnvironment");
		elm.style.display = "none";

		elm = document.getElementById("phpinfoVariables");
		elm.style.display = "none";

		elm = document.getElementById("phpinfoAll");
		elm.style.display = "none";
	}
</script>
</head>
<body>
<fieldset style="width: auto;">
	<legend align="left"><strong>Basic Configuration Check</strong></legend>
	<table border="1" cellspacing="0" cellpadding="3">
		<tr>
			<td class="tdtitle">Name</td>
			<td>filesystem.path</td>
		</tr>
		<tr>
			<td class="tdtitle">Value</td>
			<td><?= $path; ?></td>
		</tr>
		<tr>
			<td class="tdtitle">Resolved Value</td>
			<td><?= $path_exists; ?></td>
		</tr>
		<tr>
			<td class="tdtitle">Readable</td>
			<td><?= ($path_canread) ? "True" : "False (Check you what users/groups have read access to the folder)"; ?></td>
		</tr>
		<tr>
			<td class="tdtitle">Writeable</td>
			<td><?= ($path_canwrite) ? "True" : "False (Check you what users/groups have write access to the folder)"; ?></td>
		</tr>
		<tr>
			<td class="tdtitle">Status</td>
			<?= ($path_exists == "") ? "<td>The path could not be found, check you configuration.</td>" : "<td>OK</td>"; ?>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="tdtitle">Name</td>
			<td>filesystem.rootpath</td>
		</tr>
		<tr>
			<td class="tdtitle">Value</td>
			<td><?= $rootpath; ?></td>
		</tr>
		<tr>
			<td class="tdtitle">Resolved Value</td>
			<td><?= $rootpath_exists; ?></td>
		</tr>
		<tr>
			<td class="tdtitle">Readable</td>
			<td><?= ($rootpath_canread) ? "True" : "False (Check you what users/groups have read access to the folder)"; ?></td>
		</tr>
		<tr>
			<td class="tdtitle">Writeable</td>
			<td><?= ($rootpath_canwrite) ? "True" : "False (Check you what users/groups have write access to the folder)"; ?></td>
		</tr>
		<tr>
			<td class="tdtitle">Status</td>
			<?= ($rootpath_exists == "") ? "<td>The rootpath could not be found, check you configuration.</td>" : "<td>OK</td>"; ?>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="tdtitle">Name</td>
			<td>preview.wwwroot</td>
		</tr>
		<tr>
			<td class="tdtitle">Value</td>
			<td><?= $wwwroot; ?></td>
		</tr>
		<tr>
			<td class="tdtitle">Resolved Value</td>
			<td><?= $wwwroot_exists; ?></td>
		</tr>
		<tr>
			<td class="tdtitle">Status</td>
			<?= ($wwwroot_exists == "") ? "<td>The wwwroot path could not be verified, check you configuration.</td>" : "<td>OK</td>"; ?>
		</tr>
	</table>
	
</fieldset>
<br />
<a href="javascript:elementToggle('phpinfoAll');">PHPInfo</a>&nbsp;&nbsp;
<a href="javascript:elementToggle('phpinfoGeneral');">General</a>&nbsp;&nbsp;
<a href="javascript:elementToggle('phpinfoConfiguration');">Configuration</a>&nbsp;&nbsp;
<a href="javascript:elementToggle('phpinfoVariables');">Variables</a>&nbsp;&nbsp;
<a href="javascript:elementToggle('phpinfoModules');">Modules</a>&nbsp;&nbsp;
<a href="javascript:elementToggle('phpinfoEnvironment');">Environment</a><br /><br />
<div id="phpinfoAll" class="phpinfo">
<?= $info_all; ?>
</div>

<div id="phpinfoGeneral" class="phpinfo">
<?= $info_general; ?>
</div>

<div id="phpinfoVariables" class="phpinfo">
<?= $info_variables; ?>
</div>

<div id="phpinfoConfiguration" class="phpinfo">
<?= $info_configuration; ?>
</div>

<div id="phpinfoModules" class="phpinfo">
<?= $info_modules; ?>
</div>

<div id="phpinfoEnvironment" class="phpinfo">
<?= $info_environment; ?>
</div>


</body>
</html>