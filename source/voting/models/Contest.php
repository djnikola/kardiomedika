<?php
/**
 * Voting_Model Contest Entity
 *
 * @package Voting
 * @subpackage Model
 * @copyright Horisen
 * @author Zeka
 */
class Voting_Model_Contest extends Voting_Model_Entity {

    protected $_camelCase = false;
    
    protected $_id;
    protected $_name;
    protected $_start_dt;
    protected $_end_dt;
    protected $_status;
    protected $_application_id;


    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
        return $this;
    }

    public function get_name() {
        return $this->_name;
    }

    public function set_name($_name) {
        $this->_name = $_name;
        return $this;
    }

    public function get_start_dt() {
        return $this->_start_dt;
    }

    public function set_start_dt($_start_dt) {
        $this->_start_dt = $_start_dt;
        return $this;
    }

    public function get_end_dt() {
        return $this->_end_dt;
    }

    public function set_end_dt($_end_dt) {
        $this->_end_dt = $_end_dt;
        return $this;
    }

    public function get_status() {
        return $this->_status;
    }

    public function set_status($_status) {
        $this->_status = $_status;
        return $this;
    }

    public function get_application_id() {
        return $this->_application_id;
    }

    public function set_application_id($_application_id) {
        $this->_application_id = $_application_id;
        return $this;
    }


}