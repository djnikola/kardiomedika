<?php

/**
 * Route model
 *
 */
class Route {
    /**
     * singleton instance
     *
     * @var Route
     */
    protected static $_instance = null;

    /**
     *
     * @var mixed
     */
    protected $_db;

    protected $_tree = null;

    protected $_basePath = '';

    /**
     * private constructor
     */
    private function  __construct($db) {
        $this->_db = $db;
    }

    /**
     * Get Instance
     *
     * @param $db
     * @return Route
     */
    public static function getInstance($db) {
        if(self::$_instance === null) {
            self::$_instance = new self($db);
        }
        return self::$_instance;
    }

    /**
     * Send 404 header
     */
    public function pageNotFound() {
        header("HTTP/1.0 404 Not Found");
        error_log("Page not found: " . $_SERVER['REQUEST_URI']);
        throw new Exception("Page not found");
        return false;
    }

    /**
     * Route request - populate params
     *
     * @param string $baseUrl
     * @param array $request
     * @param array $availableLangs
     * @param string $defaultLang
     * @return boolean
     */
    public function route($baseUrl,&$request,$availableLangs, $defaultLang) {        
        $requestUri = $_SERVER['REQUEST_URI'];
        //process request uri
        $requestParts = parse_url($requestUri);
        $requestUri = $requestParts['path'];
        if(isset ($baseUrl) && $baseUrl != ''){
            $urlParts = parse_url($baseUrl);
            $this->_basePath = $urlParts['path'];
            if (substr($requestUri, 0, strlen($this->_basePath) ) == $this->_basePath) {
                $requestUri = substr($requestUri, strlen($this->_basePath), strlen($requestUri) );
            }
            //echo "requestUri: $requestUri<br>";die();
        }
        $requestUri = trim($requestUri, '/') ;
                    //echo "requestUri: $requestUri<br>";die();
        $path = explode('/', $requestUri);
        if(count($path) == 0) {
            $lang = $defaultLang;
            $requestUri = '/';
        }
        else {
            $lang = $path[0];
            if(!in_array($lang, $availableLangs)) {
                return $this->pageNotFound();
            }
            if(count($path) == 1) {
                $requestUri = '/';
            }
            else {
                array_shift($path);
                $requestUri = implode('/', $path);
            }
        }

        $page = $this->get($requestUri,$lang);
        if($page === FALSE){
            return $this->pageNotFound();
        }
        //populate request params
        if(isset ($page['request_params']) && $page['request_params'] != ''){
            parse_str($page['request_params'], $output);
            foreach ($output as $key => $value) {
                $request[$key] = $value;
            }
        }
        $request['lang'] = $lang;
        $request['page_id'] = $page['id'];
        return true;
    }

    /**
     * Get page array based on uri
     *
     * @param string $uri
     * @return array|false
     */
    public function get($uri,$lang) {
        $this->getPagesTree($lang);
        $path = explode('/', $uri);
        $currId = 0;
        for($i = 0; $i < count($path); $i++){
            if(!isset ($this->_tree[$currId]['child_nodes'][$path[$i]])){
                return false;
            }
            $currId = $this->_tree[$currId]['child_nodes'][$path[$i]];
        }
        return $this->_tree[$currId];
    }

    public function getPagesTree($lang, $reload = false){
        if(isset ($this->_tree) && !$reload){
            return $this->_tree;
        }
        $this->_tree = array();
        $sql = "    SELECT p.*,pt.* FROM page as p
                        LEFT JOIN page_trans as pt ON (pt.fk_page_id = p.id)
                    WHERE pt.lang = '" . addslashes(strtolower($lang)) . "'
                    ORDER BY p.level ASC,p.parent,p.ordering";
        $result = mysql_query($sql);
        if(!$result || mysql_num_rows($result) == 0) {
            return $this->_tree;
        }
        $this->_tree = array('root' => 0, 0 => array('child_nodes' => array()));
        while ($q = mysql_fetch_array($result, MYSQL_ASSOC)) {
            // if there is no parent node of current node then it is out of order, we can only skip it
            if (!isset($this->_tree[$q['parent']])) {
                continue;
            }
            // add current node in the list of parent's children
            $this->_tree[$q['parent']]['child_nodes'][$q['permalink']] = $q['id'];
            // add current note in tree
            $this->_tree[$q['id']] = $q;
            // make empty children list for current node
            $this->_tree[$q['id']]['child_nodes'] = array();
        }
        return $this->_tree;
    }


}
