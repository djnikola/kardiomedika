<?php
/**
 * CSAuthenticationImpl.class.php
 *
 * @package MCFileManager.Authenticators
 * @author CS
 * @copyright Copyright © 2008, CS.
 */

/**
 * Connects to Logik CMS db and reads/sets permissions
 *
 * @package MCFileManager.Authenticators
 */

//require_once "../../../config.php";



class CSAuthenticatorImpl extends BaseAuthenticator {
    /**#@+
	 * @access private
	 */

	var $_loggedInKey;

    /**#@+
	 * @access public
	 */

	/**
	 * Main constructor.
	 */
	function CSAuthenticatorImpl() {
	}

	/**
	 * Initializes the authenicator.
	 *
	 * @param Array $config Name/Value collection of config items.
	 */
	function init(&$config) {
		$this->_loggedInKey = $config['authenticator.session.logged_in_key'];
	}

	/**
	 * Returns a array with group names that the user is bound to.
	 *
	 * @return Array with group names that the user is bound to.
	 */
	function getGroups() {
		//
	}

	/**
	 * Returns true/false if the user is logged in or not.
	 *
	 * @return bool true/false if the user is logged in or not.
	 */
	function isLoggedin() {
		global $loged_in;
		//print_r($loged_in);exit;
		return true;
	}

	/**#@-*/
}

?>