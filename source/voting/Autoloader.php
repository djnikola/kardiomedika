<?php
/**
 * Autoloader classes
 * 
 * @copyright horisen
 * @author zeka
 */
class Autoloader {

        /**
         * Directory which contains model
         * @var string directory
         */
        private static $directories = array(
                                            "Voting_Model_" => "source/voting/models",
                                            "Voting_Form_" => "source/voting/forms"
                                            );
        /**
         * Autoload model directory
         * @param string $basePath
         */
        public static function autoload($basePath) {
            require_once ("source/voting/models/Entity.php");
            foreach(self::$directories as $namespace => $dir_path){
                foreach ( glob($basePath . $dir_path . "/*.php") as $filename ) {
                    $class = $namespace . $filename;
                    if ( !class_exists( $class ) ) {
                        require_once ($filename);
                    }
                }
            }
        }
}
?>
