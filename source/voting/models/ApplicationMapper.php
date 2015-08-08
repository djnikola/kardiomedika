<?php
/**
 * Application Mapper
 *
 * @package Application
 * @subpackage Models
 * @copyright Horisen
 * @author milan
 */
class Voting_Model_ApplicationMapper {
    /**
     * singleton instance
     *
     * @var Application_Model_ApplicationMapper
     */
    protected static $_instance = null;

    /**
     * private constructor
     */
    private function  __construct()
    {

    }

    /**
     * get instance
     *
     *
     * @return Application_Model_ApplicationMapper
     */
    public static function getInstance()
    {
        if(self::$_instance === null)
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Find and populate entity by id
     *
     * @param string $id
     * @param Voting_Model_Application $application
     * @return boolean
     */
    public function find($id, Voting_Model_Application &$application) {
        global $db;

        $sql = "SELECT * FROM application
                WHERE id='$id'";

        $result = mysql_query($sql);
        if ($result && mysql_num_rows($result)) {
            $row = mysql_fetch_array($result, MYSQL_ASSOC);
            $application = new Voting_Model_Application();
            self::rowToEntity($row, $application);
            return true;
        }else{
            return false;
        }
   }

    /**
     * Find all Applications
     * @param array $criteria
     *
     * @return array
     */
    public function fetchAll($criteria = array()) {
        global $db;

        $sql = "SELECT * FROM application AS a";
        if(isset ($criteria['status'])){
            $sql .= " a.status =" . $criteria['status'];
        }
   
        $result = mysql_query($sql);
        $applications   = array();

        if ($result && mysql_num_rows($result)) {
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $application = new Voting_Model_Application();
                self::rowToEntity($row, $application);
                $applications[] = $application;
            }
            return $applications;
        }else{
            return false;
        }
    }

    /**
     * This function is used to decoding signed_request data
     * more information is here http://developers.facebook.com/docs/authentication/signed_request
     */
    public static function parseSignedRequest($signed_request, $secret) {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        // decode the data
        $sig = base64_decode(strtr($encoded_sig, '-_', '+/'));
        $data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);

        if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
            error_log('Unknown algorithm. Expected HMAC-SHA256');
            return null;
        }

        // check sig
        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }

        return $data;
    }

    /**
     * Find and populate entity by signed request
     *
     * @param string $signedRequest
     * @param Voting_Model_Application $application
     * @return boolean
     */
    public function findBySignedRequest($signedRequest, Voting_Model_Application &$application) {
        $apps = $this->fetchAll();
        /* @var $currApplication Application_Model_Application */
        foreach ($apps as $currApplication) {
            $decodedSignedRequest = self::parseSignedRequest($signedRequest, $currApplication->get_fb_settings('api_secret'));
            if($decodedSignedRequest != null){
                $application = $currApplication;
                $application->set_signed_request($decodedSignedRequest);
                return true;
            }            
        }
        return false;
    }

    /**
     * Covert entity to array
     * 
     * @param Voting_Model_Application $application
     * @param boolean $notNull
     */
    public static function getData(Voting_Model_Application $application, $notNull = true){
        $data = array();
        $fields = array('id','name','status','status_dt','style_json','fb_settings','email_settings','settings');

        foreach ($fields as $field) {
            $value = $application->__get($field);
            if($value != null || !$notNull){
                if(in_array($field, array('style_json','fb_settings','email_settings','settings'))){
                    $value = json_encode($value);
                }
                $data[$field] = $value;
            }
        }

        return $data;
    }

    /**
     * Convert DB row to entity object
     * 
     * @param Zend_Db_Table_Row_Abstract $row
     * @param Voting_Model_Application $application
     */
    public static function rowToEntity(array $row, Voting_Model_Application $application){
        $application    ->set_email_settings(self::getJsonSetings($row['email_settings']))
                        ->set_fb_settings(self::getJsonSetings($row['fb_settings']))
                        ->set_id($row['id'])
                        ->set_name($row['name'])
                        ->set_status($row['status'])
                        ->set_status_dt($row['status_dt'])
                        ->set_style_json(self::getJsonSetings($row['style_json']))
                        ->set_settings(self::getJsonSetings($row['settings']));
    }

    private static function getJsonSetings($json){
        return (isset ($json) && $json != '')?json_decode($json, true):array();
    }
}