<?php
    require_once 'controllers/Factory.php';
    require_once 'Autoloader.php';
    require_once 'Utils.php';
    //run autoloader
    Autoloader::autoload(BASE_PATH);
    //add envirement variables to the controller
    $envirement = array(
                        "smarty" => $smarty,
                        "lang" => $lang,
                        "base_path" => BASE_PATH,
                        "meta" => $meta
                        );
    //create controller
    $controller = Factory::createController($subsection, $envirement);
    $controller->run();
    //set meta
    $meta = $controller->getMeta();
    //get template for this controller
    $template = $controller->getTemplate();
    //use module path of template
    $smarty->assign("zend_module", true);
?>
