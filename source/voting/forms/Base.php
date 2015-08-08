<?php
/**
 * Base
 * 
 * 
 */
class Voting_Form_Base {

    /**
     * Validator rules
     * @var array
     */
    private $validatorRules;

    /**
     * Filter rules
     * @var array
     */
    private $filterRules;

    /**
     * Messages
     * @var array
     */
    private $messages;
    
    /**
     * Data
     * @var string data
     */
    private $data;

    /**
     * Constructor
     *
     * @param array $data
     * @param array $options
     * @param Application_Model_Application $application
     */
    public function __construct($filterRules,  $validatorRules,  array $data ) {
        $this->validatorRules = $validatorRules;
        $this->filterRules = $filterRules;
        $this->data = $this->_filter($data);
    }

    /**
     * Validate
     */
    public function isValid(){
        foreach($this->validatorRules as $key => $rules){
            foreach($rules as $rule){
                if( !$this->_isVaildRule($key, $rule) ){
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Get messages
     * @return array
     */
    public function getMessages() {
        return $this->messages;
    }

    /**
     * Get values
     * @return array
     */
    public function getValues() {
        return $this->data;
    }


    //-------------- Private functions ---------//


    /**
     * Filter data
     *
     * @param array $filterRules
     * @param array $data
     */
    private function _filter( &$data ){
        foreach($this->filterRules as $filterKey){
            $data[$filterKey] = trim($data[$filterKey]);
        }
        return $data;
    }

    /**
     * Validate rule
     *
     * @param string $key
     * @param string $rule
     * @param array $data
     * @return bool
     */
    private function _isVaildRule($key, $rule){
        switch($rule){
                case 'presence':
                    if( isset($this->data[$key]) ){
                        return true ;
                    }else{
                        $this->messages[] =  $key . " is need to be presence.";
                        return false;
                    }
                case 'notempty':
                    if( isset($this->data[$key]) && $this->data[$key] != "" ){
                        return true;
                    }else{
                        $this->messages[] =  $key . " can not be empty.";
                        return false;
                    }
                case 'email':
                    if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $this->data[$key])) {
                        return true;
                    }
                    else {
                        $this->messages[] =  $key . " is not valid.";
                        return false;
                    }
                case 'notexist':
                    require_once('validators/Email.php');
                    $emailValidator = new EmailValidator($this->data[$key]);
                    if($emailValidator->isValid()){
                        return true;
                    }else{
                        $this->messages[] =  $emailValidator->getErrorMessage();
                        return false;
                    }
               default:
                   return true;
        }
    }

}
?>
