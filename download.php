<?php
if (isset($_SERVER["SCRIPT_FILENAME"])) {
    $aplPath = str_replace("//","/",str_replace("\\","/",dirname($_SERVER["SCRIPT_FILENAME"])));
} else {
    $aplPath = str_replace("//","/",str_replace("\\","/",dirname($_SERVER["PATH_TRANSLATED"])));
}

$file = (isset($_GET["file"]) && $_GET["file"] != "") ? $_GET["file"] : "";

if (file_exists($aplPath."/contents/".$file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octetstream');
    header('Content-Disposition: attachment; filename="'.$file.'"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($aplPath."/contents/".$file));
    ob_clean();
    flush();
    readfile($aplPath."/contents/".$file);
    exit;
} else {
    echo "File not exist!";
}

?>