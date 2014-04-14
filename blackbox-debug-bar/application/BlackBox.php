<?php

/**
 * Main BlackBox class
 *
 * @author Grzegorz Winiarski
 * @package BlackBox
 * @license GPL
 */

class BlackBox
{
    /**
     * Filter name to trace
     */
    const DEBUG = "debug";

    /**
     * (Singleton) Insatnce of BlackBox object
     *
     * @var BlackBox
     */
    private static $_instance = null;

    /**
     * List of globals
     *
     * Globals will be stored in the array in case someone will want to
     * modify them
     *
     * @var array
     */
    private $_globals = array(
        'get' => null,
        'post' => null,
        'cookie' => null,
        'session' => null,
        'server' => null
    );

    /**
     * Profiler object
     *
     * @var BlackBox_Profiler
     */
    private $_profiler = null;

    /**
     * List of catched errors by BlackBox error handler.
     *
     * @var BlackBox_Error[]
     */
    private $_error = array();

    /**
     *
     * @var string
     */
    private $_path = null;

    private function __construct()
    {
        $this->_profiler = new BlackBox_Profiler();
        $this->_globals = array(
            'get' => isset($_GET) ? $_GET : array(),
            'post' => isset($_POST) ? $_POST : array(),
            'cookie' => isset($_COOKIE) ? $_COOKIE : array(),
            'session' => isset($_SESSION) ? $_SESSION : array(),
            'server' => isset($_SERVER) ? $_SERVER : array()
        );
    }

    /**
     * Returns profiler object
     *
     * @return BlackBox_Profiler
     */
    public function getProfiler()
    {
        return $this->_profiler;
    }

    /**
     * Returns all global arrays copies
     *
     * @return array
     */
    public function getGlobals()
    {
        return $this->_globals;
    }

    /**
     * Returns selected (by $name) global array
     *
     * @param string $name Global array name
     * @return array
     * @throws BlackBox_Exception If global array does not exists
     */
    public function getGlobal($name)
    {
        $name = strtolower($name);
        if(!array_key_exists($name, $this->_globals)) {
            throw new BlackBox_Exception("Global $name does not exist.", 100);
        }

        return $this->_globals[$name];
    }

    /**
     * Retuns BlackBox instance.
     *
     * Note. There can be only one instance of BlackBox object.
     *
     * @return BlackBox
     */
    public static function getInstance()
    {
        if(self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public static function errorHandler($errno, $errstr, $errfile, $errline)
    {
        if($errno == 8) {
            $errname = "Notice";
        } elseif ($errno == 2) {
            $errname = "Warning";
        } elseif ($errno == 8192) {
            $errname = "Deprecated";
        } elseif ($errno == 2048) {
            $errname = "Strict";
        } else {
            $errname = "Unknown";
        }

        $hash = md5($errline.$errfile.$errstr.$errno);

        if(array_key_exists($hash, self::getInstance()->_error)) {
            self::getInstance()->_error[$hash]['count']++;
        } else {
            self::getInstance()->_error[$hash] = array(
                "errno" => $errno,
                "message" => $errstr,
                "file" => $errfile,
                "name" => $errname,
                "line" => $errline,
                "count" => 0
            );
        }

    }

    /**
     * Returns all errors catched by {@see self::errorHandler()} method.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->_error;
    }

    /**
     * Initiates BlackBox plugin
     *
     * @return null
     */
    public static function init()
    {        
		// init profiler
        add_filter("all", array("BlackBox_Hook", "profiler"));
        apply_filters('debug', 'Profiler Initiaded');
        apply_filters('debug', 'Profiler Noise');

		add_action('init', array('BlackBox', 'init_scripts_styles'));
        add_action('admin_footer', array("BlackBox_Hook", "footer"));
        add_action('wp_footer', array("BlackBox_Hook", "footer"));

        set_error_handler(array("BlackBox", "errorHandler"), E_ALL | E_STRICT);
    }
	
	public static function init_scripts_styles()
    {
        wp_register_script("blackbox-js", plugins_url()."/blackbox-debug-bar/public/highlight.pack.js", array("jquery"));
        wp_register_script("blackbox-highlight", plugins_url()."/blackbox-debug-bar/public/blackbox.js", array("jquery"));

        wp_register_style("blackbox-css", plugins_url()."/blackbox-debug-bar/public/styles.css");
		wp_enqueue_style("blackbox-css");

		wp_enqueue_script("blackbox-js");
		wp_enqueue_script("blackbox-highlight");
	}
}

