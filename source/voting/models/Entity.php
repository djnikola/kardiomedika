<?php
/**
 * Base entity model.
 *
 * @package voting
 * @subpackage Model
 * @copyright Horisen
 * @author zeka
 */
class Voting_Model_Entity {

    protected $_camelCase = true;

    /**
     * constructor
     */
    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Set a new/current value
     *
     * @param string $name
     * @param multiple $value
     * @return  multiple
     */
    public function __set($name, $value) {
        if($this->_camelCase){
            $method = 'set' . $name;
        }
        else{
            $method = 'set_' . $name;
        }
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Entity property');
        }
        $this->$method($value);
    }

    /**
     * Get a name from the values
     *
     * @param string $name
     */
    public function __get($name) {
        if($this->_camelCase){
            $method = 'get' . $name;
        }
        else{
            $method = 'get_' . $name;
        }
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Entity property');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            if($this->_camelCase){
                $method = 'set' . ucfirst($key);
            }
            else{
                $method = 'set_' . $key;
            }
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function toArray($options = null) {
        $result = array();
        if(!is_array($options)){
            $properties = get_object_vars($this);
            $options = array();
            foreach ($properties as $property => $value) {
                $options[] = ltrim($property, "_");
            }
        }
        foreach ($options as $key) {
            if($this->_camelCase) {
                $method = 'get' . ucfirst($key);
            }
            else {
                $method = 'get_' . $key;
            }
            if (method_exists($this, $method)) {
                $result[$key] = $this->$method();
            }
        }
        return $result;
    }

}
?>