<?php
/**
 * Voting_Model Candidate Entity
 *
 * @package Voting
 * @subpackage Model
 * @copyright Horisen
 * @author Zeka
 */
class Voting_Model_Candidate extends Voting_Model_Entity {

    protected $_camelCase = false;

    protected $_id;
    protected $_contest_id;
    protected $_name;
    protected $_description;
    protected $_image_path;
    protected $_order_num;
    protected $_votes;

    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
        return $this;
    }

    public function get_contest_id() {
        return $this->_contest_id;
    }

    public function set_contest_id($_contest_id) {
        $this->_contest_id = $_contest_id;
        return $this;
    }

    public function get_name() {
        return $this->_name;
    }

    public function set_name($_name) {
        $this->_name = $_name;
        return $this;
    }

    public function get_description() {
        return $this->_description;
    }

    public function set_description($_description) {
        $this->_description = $_description;
        return $this;
    }

    public function get_image_path() {
        return $this->_image_path;
    }

    public function set_image_path($_image_path) {
        $this->_image_path = $_image_path;
        return $this;
    }

    public function get_order_num() {
        return $this->_order_num;
    }

    public function set_order_num($_order_num) {
        $this->_order_num = $_order_num;
        return $this;
    }

    public function get_votes() {
        return $this->_votes;
    }

    public function set_votes($_votes) {
        $this->_votes = $_votes;
        return $this;
    }

}