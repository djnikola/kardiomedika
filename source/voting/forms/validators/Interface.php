<?php
/**
 * Validtor Interface
 * 
 * @copyright horisen
 * @author zeka
 */
interface ValidatorInterface {

    /**
     * Check is valid
     */
    public function isValid();

    /**
     * Get error message
     */
    public function getErrorMessage();

}
?>
