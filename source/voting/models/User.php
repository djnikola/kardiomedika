<?php
/**
 * Voting_Model User Entity
 *
 * @package Voting
 * @subpackage Models
 * @copyright Horisen
 * @author Zeka
 */
class Voting_Model_User  extends Voting_Model_Entity {

    protected $_camelCase = false;

    protected $_id;
    protected $_first_name;
    protected $_last_name;
    protected $_email;
    protected $_created;


    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
        return $this;
    }

    public function get_first_name() {
        return $this->_first_name;
    }

    public function set_first_name($_first_name) {
        $this->_first_name = $_first_name;
        return $this;
    }

    public function get_last_name() {
        return $this->_last_name;
    }

    public function set_last_name($_last_name) {
        $this->_last_name = $_last_name;
        return $this;
    }

    public function get_email() {
        return $this->_email;
    }

    public function set_email($_email) {
        $this->_email = $_email;
        return $this;
    }

    public function get_created() {
        return $this->_created;
    }

    public function set_created($_created) {
        $this->_created = $_created;
        return $this;
    }

}