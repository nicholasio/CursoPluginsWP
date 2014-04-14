<?php
/**
 * BlackBox Hooks
 *
 * This class handles execution of BlackBox hooks and filters
 *
 * @author Grzegorz Winiarski
 * @package BlackBox
 * @license GPL
 */

class BlackBox_Hook
{
    public static function profiler()
    {
        if(func_get_arg(0) != BlackBox::DEBUG) {
            return;
        }

        BlackBox::getInstance()->getProfiler()->trace(func_get_arg(1));
    }

    public static function footer()
    {
        apply_filters('debug', 'Profiler Stopped');
        include_once BLACKBOX_DIR."/application/debug-bar.php";
    }
}
