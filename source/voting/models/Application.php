<?php
/**
 * Application Entity class
 *
 * @package Application
 * @subpackage Models
 * @copyright Horisen
 * @author zeka
 */
class Voting_Model_Application extends Voting_Model_Entity
{
    protected $_camelCase = false;
    protected $_id;
    protected $_name;
    protected $_status;
    protected $_status_dt;
    protected $_style_json;
    protected $_fb_settings;
    protected $_email_settings;
    protected $_settings;
    /**
     *
     * @var array
     */
    protected $_signed_request;

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

    public function get_status() {
        return $this->_status;
    }

    public function set_status($_status) {
        $this->_status = $_status;
        return $this;
    }

    public function get_status_dt() {
        return $this->_status_dt;
    }

    public function set_status_dt($_status_dt) {
        $this->_status_dt = $_status_dt;
        return $this;
    }

    public function get_style_json() {
        return $this->_style_json;
    }

    public function set_style_json($_style_json) {
        $this->_style_json = $_style_json;
        return $this;
    }

    public function get_fb_settings($key = null) {
        if(!isset ($key)){
            return $this->_fb_settings;
        }
        else{
            if(isset ($this->_fb_settings[$key])){
                return $this->_fb_settings[$key];
            }
            else{
                return null;
            }
        }
    }

    public function set_fb_settings($_fb_settings) {
        $this->_fb_settings = $_fb_settings;
        return $this;
    }

    public function get_email_settings() {
        return $this->_email_settings;
    }

    public function set_email_settings($_email_settings) {
        $this->_email_settings = $_email_settings;
        return $this;
    }

    public function get_signed_request() {
        return $this->_signed_request;
    }

    public function set_signed_request($_signed_request) {
        $this->_signed_request = $_signed_request;
        return $this;
    }

    public function get_settings($key = null) {
        if(!isset ($key)){
            return $this->_settings;
        }
        else{
            if(isset ($this->_settings[$key])){
                return $this->_settings[$key];
            }
            else{
                return null;
            }
        }
    }

    public function set_settings($_settings) {
        $this->_settings = $_settings;
        return $this;
    }



}