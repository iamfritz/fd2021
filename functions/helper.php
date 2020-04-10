<?php
/*
 * Helper
 */

if (! function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function dd($x, $d=true)
    {
        array_map(function($x) { 
            var_dump($x); 
        }, func_get_args());

        if($d) die(1);
    }
}
