<?php
/**
 * BlackBox profiler class
 *
 * @author Grzegorz Winiarski
 * @package BlackBox
 * @license GPL
 */

class BlackBox_Profiler
{
    /**
     * Array traced items
     *
     * Each array items contains information about: execution time,
     * memory usage and name
     *
     * @var array
     */
    private $_timer = array();

    /**
     * Time of the execution of first {@see self::trace()}
     *
     * @var int In microseconds
     */
    private $_init = null;

    /**
     * Time of the execution of last {@see self::trace()}
     *
     * @var int In microseconds
     */
    private $_stop = null;

    /**
     * Profiler main function for measuring execution time
     *
     * @param string $name
     */
    public function trace($name)
    {
        $mtime = microtime(true);

        if(!$this->_init) {
            $this->_init = $mtime;
        }

        $this->_timer[] = array(
            "name" => $name,
            "time" => $mtime,
            "memory" => memory_get_peak_usage()
        );

        $this->_stop = $mtime;
    }

    public function getMeasure()
    {
        return $this->_timer;
    }

    /**
     * Returns time when {@see self::trace()} was first executed
     *
     * @return int Microseconds
     */
    public function getInit()
    {
        return $this->_init;
    }
    
    /**
     * Difference in microseconds between first and last time when
     * trace method was called
     *
     * @return int Microseconds
     */
    public function totalTime()
    {
        return $this->_stop - $this->_init;
    }
}
