<?php
include_once 'FactoryInterface.php';
/**
 * Factory 
 * 
 * @copyright horisen
 * @author zeka
 */
class Factory implements FactoryInterface {

    /**
     * Voting Factory
     *
     * @param string $name
     * @param array $envirement
     * return Controller
     */
    public static function createController($name, $envirement){
        $class = ucfirst($name)  . 'Controller';
        if (!class_exists( $class )) {
            self::loadClass($class);
        }
        $controller =  new $class($envirement);
        $controller->setTemplate("voting/views/scripts/" . $name . ".tpl");
        return $controller;
    }

    /**
     * Load controller class
     * @param string $class
     */
    private static function loadClass($class) {
        include_once 'Controller.php';
        include_once $class . '.php';
    }
    
}
?>
