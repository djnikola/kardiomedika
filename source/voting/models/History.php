<?php
/**
 * Voting_Model History Entity
 *
 * @package Voting
 * @subpackage Model
 * @copyright Horisen
 * @author Zeka
 */
class Voting_Model_History extends Voting_Model_Entity {

       protected $_camelCase = false;

       protected $_id;
       protected $_posted;
       protected $_contest_id;
       protected $_candidate_id;
       protected $_user_id;
       protected $_status;
       protected $_code;

       public function get_id() {
           return $this->_id;
       }

       public function set_id($_id) {
           $this->_id = $_id;
           return $this;
       }

       public function get_posted() {
           return $this->_posted;
       }

       public function set_posted($_posted) {
           $this->_posted = $_posted;
           return $this;
       }

       public function get_contest_id() {
           return $this->_contest_id;
       }

       public function set_contest_id($_contest_id) {
           $this->_contest_id = $_contest_id;
           return $this;
       }

       public function get_candidate_id() {
           return $this->_candidate_id;
       }

       public function set_candidate_id($_candidate_id) {
           $this->_candidate_id = $_candidate_id;
           return $this;
       }

       public function get_user_id() {
           return $this->_user_id;
       }

       public function set_user_id($_user_id) {
           $this->_user_id = $_user_id;
           return $this;
       }

       public function get_status() {
           return $this->_status;
       }

       public function set_status($_status) {
           $this->_status = $_status;
           return $this;
       }

       public function get_code() {
           return $this->_code;
       }

       public function set_code($_code) {
           $this->_code = $_code;
           return $this;
       }

}