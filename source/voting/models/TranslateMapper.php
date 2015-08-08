<?php
/**
 * Translate Mapper
 * 
 * @package Voting
 * @subpackage Model
 * @copyright Horisen
 * @author Zeka
 */
class Voting_Model_TranslateMapper {

    /**
     * singleton instance
     *
     * @var Voting_Model_TranslateMapper
     */
    protected static $_instance = null;
    
    /**
     * private constructor
     */
    private function __construct() {
           global $db;
    }

    /**
     * get instance
     * @return Voting_Model_TranslateMapper
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Find all translation by language and section
     * @param string $language
     * @param string $section
     * @param array $translate
     * @return bool
     */
    public function findAll($language, $section, &$translate) {
        $sql = "SELECT * FROM voting_trans AS t
                WHERE t.language = '$language' AND t.section='$section'
                ORDER BY t.id";

        $result = mysql_query($sql);

        if ($result && mysql_num_rows($result)) {
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $translate[] = $row;
            }
            return true;
        }else{
            return false;
        }
    }

    /**
     * Find translation by language, section, key
     * @param string $language
     * @param string $section
     * @param string $key
     * @param array $translate
     * @return bool
     */
    public function find($language, $section, $key, &$translate) {
        $sql = "SELECT * FROM voting_trans AS t
                WHERE t.language = '$language' AND t.section='$section' AND t.key='$key'";

        $result = mysql_query($sql);
        if(!$result || ($resultSet = mysql_fetch_array($result, MYSQL_ASSOC)) === false){
            return false;
        }

        $translate = $resultSet;
        return true;
    }

    /**
     * Read meta data
     * @param string $language
     * @param string $section
     * @param array $meta
     * @return bool
     */
    public function readMetaData($language, $section, &$meta){
        $translates = array();
        if($this->findAll($language, $section, $translates)){
            foreach($translates as $trans){
                if($trans['key'] == 'meta_title'){
                    $meta['title'] = $trans['value'];
                }
                if($trans['key'] == 'meta_description'){
                    $meta['description'] = $trans['value'];
                }
                if($trans['key'] == 'meta_keywords'){
                    $meta['keywords'] = $trans['value'];
                }
            }
            return true;
        }
        return false;
    }

}