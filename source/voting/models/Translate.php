<?php
/**
 * Voting_Model Translate Entity
 *
 * @package Voting
 * @subpackage Model
 * @copyright Horisen
 * @author Zeka
 */
class Voting_Model_Translate extends Voting_Model_Entity {

    protected $_camelCase = false;

    protected $_id;
    protected $_language;
    protected $_module;
    protected $_key;
    protected $_value;

    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
        return $this;
    }

    public function get_language() {
        return $this->_language;
    }

    public function set_language($_language) {
        $this->_language = $_language;
        return $this;
    }

    public function get_module() {
        return $this->_module;
    }

    public function set_module($_module) {
        $this->_module = $_module;
        return $this;
    }

    public function get_key() {
        return $this->_key;
    }

    public function set_key($_key) {
        $this->_key = $_key;
        return $this;
    }

    public function get_value() {
        return $this->_value;
    }

    public function set_value($_value) {
        $this->_value = $_value;
        return $this;
    }

}