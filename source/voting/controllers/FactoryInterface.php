<?php
/**
 * Factory interface
 *
 * @copyright horisen
 * @author zeka
 */
interface FactoryInterface {

    /**
     * Create controller method
     *
     * @param string $name
     * @param array $envirement
     * return Controller
     */
    public static function createController($name, $envirement);
}

?>
