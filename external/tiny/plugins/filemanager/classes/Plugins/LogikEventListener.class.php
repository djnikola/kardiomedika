<?php
/**
 * LogikEventListener.php
 *
 * @package MCFileManager.filesystems
 * @author Logik
 * @copyright Copyright © 2008, Logik d.o.o.
 */

/**
 * This class logs any modifications made by the MCFileManager.
 */
class LogikEventListener {
	// Private fields
	var $_logPath;
	var $_logPrefix;
	var $_logMaxSize;
	var $_logMaxFiles;
	var $_logMaxSizeBytes;

	/**
	 * Initializes the FileEventListener by the specified config.
	 *
	 * @param Array name/value array of config data.
	 */
	function init(&$config) {
	}

	/**
	 * Action event handler.
	 *
	 * @param int $action Action ID.
	 * @param File $file1 File object 1.
	 * @param File $file2 File object 2.
	 */
	function handleFileAction($action, $file1, $file2) {
		switch ($action) {
			case DELETE_ACTION:
				security_log(SEC_RES_UPLOAD,0,SEC_ACT_DELETE,"обрисан фајл: " . $file1->getAbsolutePath());
				break;

			case ADD_ACTION:
				security_log(SEC_RES_UPLOAD,0,SEC_ACT_CREATE,"уплоадован фајл: " . $file1->getAbsolutePath());
				break;

			case UPDATE_ACTION:
				security_log(SEC_RES_UPLOAD,0,SEC_ACT_UPDATE,"измењен фајл: " . $file1->getAbsolutePath());
				break;

			case RENAME_ACTION:
				security_log(SEC_RES_UPLOAD,0,SEC_ACT_UPDATE,"преименован фајл из " . $file1->getAbsolutePath() . " у " . $file2->getAbsolutePath());
				break;

			case COPY_ACTION:
				security_log(SEC_RES_UPLOAD,0,SEC_ACT_UPDATE,"копиран фајл из " . $file1->getAbsolutePath() . " у " . $file2->getAbsolutePath());
				break;

			case MKDIR_ACTION:
				security_log(SEC_RES_UPLOAD,0,SEC_ACT_CREATE,"креиран директоријум: " . $file1->getAbsolutePath());
				break;

			case RMDIR_ACTION:
				security_log(SEC_RES_UPLOAD,0,SEC_ACT_DELETE,"обрисан директоријум: " . $file1->getAbsolutePath());
				break;

			default:
				security_log(SEC_RES_UPLOAD,0,SEC_ACT_UPDATE,"непозната акција: " . $file1->getAbsolutePath());
		}
	}
}

?>
