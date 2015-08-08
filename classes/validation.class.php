<?php
/**
 * This class encapsulates various validation functionality.
 *
 * PHP developers should always validate data on the server
 * side to prevent Problems. JavaScript alone is not a good
 * idea for data validation.
 *
 * Feb 20, 2007 - Initial Release
 * Feb 28, 2007 - Vitaliy Bogdanets contributed regular expressions
 * Mar 12, 2007 - Restructured/renamed class, made static, added functionality
 * Mar 27, 2007 - Added GetBooleanValue method
 *
 * @version 2.1
 * @author Jeff L. Williams
 */
class validation
{
    /**
     * Checks the length of a value
     *
     * @param string  $value The value to check
     * @param integer $maxLength The maximum allowable length of the value
     * @param integer $minLength [Optional] The minimum allowable length
     * @return boolean TRUE if the requirements are met, FALSE if not
     */
     public function checkLength($value, $maxLength, $minLength = 0)
    {
        if (!(strlen($value) > $maxLength) && !(strlen($value) < $minLength)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks the minimum length of a value
     *
     * @param string  $value The value to check
     * @param integer $minLength The minimum allowable length
     * @return boolean TRUE if the requirements are met, FALSE if not
     */
     public function checkMinimumLength($value, $minLength)
    {
        if (strlen($value) < $minLength) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Compares two values for equality
     *
     * @param string  $value1 First value to compare
     * @param string  $value2 Second value to compare
     * @param boolean $caseSensitive [Optional] TRUE if compare is case sensitive
     * @return boolean TRUE if the values are equal and FALSE if not
     */
     public function compare($value1, $value2, $caseSensitive = false)
    {
        if ($caseSensitive) {
            return ($value1 ==  $value2 ? true : false);
        } else {
            if (strtoupper($value1) ==  strtoupper($value2)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Converts any value of any datatype into boolean (true or false)
     *
     * @param any $value Value to analyze for TRUE or FALSE
     * @param any $includeTrueValue (Optional) return TRUE if the value equals this
     * @param any $includeFalseValue (Optional) return FALSE if the value equals this
     * @return boolean Returns TRUE or FALSE
     */
     public function getBooleanValue($value, $includeTrueValue = null, $includeFalseValue = null) {

        if (!(is_null($includeTrueValue)) && $value == $includeTrueValue) {
            return true;
        } elseif (!(is_null($includeFalseValue)) && $value == $includeFalseValue) {
            return false;
        } else {
            if (gettype($value) == "boolean") {
                if ($value == true) {
                    return true;
                } else {
                    return false;
                }
            } elseif (is_numeric($value)) {
                if ($value > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $cleaned = strtoupper(trim($value));

                if ($cleaned == "ON") {
                    return true;
                } elseif ($cleaned == "SELECTED" || $cleaned == "CHECKED") {
                    return true;
                } elseif ($cleaned == "YES" || $cleaned == "Y") {
                    return true;
                } elseif ($cleaned == "TRUE" || $cleaned == "T") {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    /**
     * Get the value for a cookie by the cookie name
     *
     * @param string  $name The name of the cookie
     * @return string The cookie value
     */
     public function getCookieValue($name)
    {
        if (isset($_COOKIE[$name]))
        {
            return $_COOKIE[$name];
        } else {
            return '';
        }
    }

    /**
     * Get a POST or GET value by a form element name
     *
     * @param string  $name The name of the POST or GET data
     * @return string The value of the form element
     */
     public function getFormValue($name)
    {
        if (isset($_POST[$name]))
        {
            return $_POST[$name];
        } else {
            if (isset($_GET[$name]))
            {
                return $_GET[$name];
            } else {
                return '';
            }
        }
    }

    /**
     * Get the value for a session by the session name
     *
     * @param string  $name The name of the session
     * @return string The session value
     */
     public function getSessionValue($name)
    {
        if (isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        } else {
            return '';
        }
    }

    /**
     * Get a POST, GET, Session, or Cookie value by name
     * (in that order - if one doesn't exist, the next is tried)
     *
     * @param string  $name The name of the POST, GET, Session, or Cookie
     * @return string The value from that element
     */
     public function getValue($name)
    {
        if (isset($_POST[$name]))
        {
            return $_POST[$name];
        } else {
            if (isset($_GET[$name]))
            {
                return $_GET[$name];
            } else {
                if (isset($_SESSION[$name]))
                {
                    return $_SESSION[$name];
                } else {
                    if (isset($_COOKIE[$name]))
                    {
                        return $_COOKIE[$name];
                    } else {
                        return '';
                    }
                }
            }
        }
    }

    /**
     * Checks to see if a variable contains a value
     *
     * @param string  $value The value to check
     * @return boolean TRUE if a value exists, FALSE if empty
     */
     public function hasValue($value)
    {
        if (strlen($value) < 1 || empty($value) || is_null($value)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Determines if a string is alpha only
     *
     * @param string $value The value to check for alpha (letters) only
     * @param string $allow Any additional allowable characters
     * @return boolean
     */
     public function isAlpha($value, $allow = '')
    {
        if (preg_match('/^[a-zA-Z' . $allow . ']+$/', $value))
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determines if a string is alpha-numeric
     *
     * @param string $value The value to check
     * @return boolean TRUE if there are letters and numbers, FALSE if other
     */
     public function isAlphaNumeric($value)
    {
        if (preg_match("/^[A-Za-z0-9 ]+$/", $value))
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determines if a string contains a valid date
     *
     * @param string $value The value to inspect
     * @return boolean TRUE if the value is a date, FALSE if not
     */
     public function isDate($value)
    {
        $date = date('Y', strtotime($value));
        if ($date == "1969" || $date == '')
        {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Checks for a valid email address
     *
     * @param string  $email The value to validate as an email address
     * @return boolean TRUE if it is a valid email address, FALSE if not
     */
     public function isEmail($email)
    {
        $pattern = "/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/";

        
        if (preg_match($pattern, $email))
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks to see if a variable contains no value (not even a zero)
     *
     * @param string  $value The value to check
     * @return boolean TRUE if a value exists, FALSE if empty
     */
     public function isEmpty($value)
    {
        if (strlen($value) < 1 || is_null($value)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks for a valid internet URL
     *
     * @param string $value The value to check
     * @return boolean TRUE if the value is a valid URL, FALSE if not
     */
     public function isInternetURL($value)
    {
        if (preg_match("/^http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?$/i", $value))
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks for a valid IP Address
     *
     * @param string $value The value to check
     * @return boolean TRUE if the value is an IP address, FALSE if not
     */
     public function isIPAddress($value)
    {
        $pattern = "/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/i";
        if (preg_match($pattern, $value))
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks to see if a variable is a number
     *
     * @param integer $number The value to check
     * @return boolean TRUE if the value is a number, FALSE if not
     */
     public function isNumber($number)
    {
        if (preg_match("/^\-?\+?[0-9e1-9]+$/", $number))
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks for a two character state abbreviation
     *
     * @param string $value The value to inspect
     * @return boolean TRUE if the value is a 2 letter state abbreviation
     *                 FALSE if the value is anything else
     */
     public function isStateAbbreviation($value)
    {
        if (preg_match("/^[A-Z][A-Z]$/i", $value))
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks to see if a variable is an unsigned number
     *
     * @param integer $number The value to inspect
     * @return boolean TRUE if the value is a number without a sign
     *                 and FALSE if a sign exists
     */
     public function isUnsignedNumber($number)
    {
        if (preg_match("/^\+?[0-9]+$/", $number))
        {
            return true;
        } else {
            return false;
        }
    }

}
?>