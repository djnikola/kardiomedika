<?php
require_once 'ControllerInterface.php';
/**
 * Base Controller
 *
 * @package Voting
 * @copyright horisen
 * @author zeka 
 */
class Controller implements ControllerInterface {

    protected $envirement;

    protected $template;

    protected $meta;

    public function  __construct($envirement) {
        $this->envirement = $envirement;
        $this->meta = isset($envirement['meta']) ? $envirement['meta'] : null;
        $this->_init();
    }

    protected function _init(){

    }

    /**
     * Run method
     */
    public function run(){
        throw new Exception("Run method not impelemented!");
    }

    /**
     * Get request param
     *
     * @param string $name
     * @return string
     */
    protected function getRequestParam($name){
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : null;
    }

    /**
     * Get request params
     * @return array
     */
    protected function getRequestParams(){
        return $_REQUEST;
    }

    /**
     * Get smarty
     * @return <type>
     */
    protected function getSmarty(){
        return isset($this->envirement) && isset($this->envirement['smarty']) ? $this->envirement['smarty'] : null;
    }

    /**
     * Get  base path
     * @return string
     */
    protected function getBasePath(){
        return isset($this->envirement) && isset($this->envirement['base_path']) ? $this->envirement['base_path'] : "";
    }

    /**
     * Get meta
     * @return array
     */
    public function getMeta(){
        return $this->meta;
    }

    /**
     * Get template
     * @return string
     */
    public function getTemplate(){
        return $this->template;
    }

    /**
     * Set template
     * @param string $template
     */
    public function setTemplate($template){
        $this->template = $template;
    }

    /**
     * sendJson
     * @param array $response
     */
    protected function sendJson($response) {
        $output = json_encode($response);
        echo $output;
    }


    /**
     * Get template
     * @return string
     */
    public function getLanguage(){
        return isset($this->envirement) && isset($this->envirement['lang']) ? $this->envirement['lang'] : 'en';
    }

}
?>
