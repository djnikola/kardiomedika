<?php
require_once 'Base.php';
/**
 * Voting forms vote
 *
 * @package Voting
 * @subpackage Forms
 * @copyright Horisen
 * @author zeka
 */
class Voting_Form_Vote extends Voting_Form_Base
{
    /**
     * Constructor
     *
     * @param array $data
     * @param array $options
     * @param Application_Model_Application $application
     */
    public function __construct( array $data ) {

        $filterRules = array(
            'candidate',
            'email' 
        );

        $validatorRules = array(
            //-------- page -------//
            'candidate'   => array(
                'presence',
                'digit',
                'notempty'
             ),
            'email'  => array(
                'presence',
                'notempty',
                'email',
                'notexist'
            )
        );

        parent::__construct($filterRules, $validatorRules, $data);
    }


}