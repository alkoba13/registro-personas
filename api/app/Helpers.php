<?php

/**
 * Functions generic
 * PHP Version 8.3.6
 *
 * @category Helpers
 * @package  PERSONS TEST
 * @author   Angel Sandoval <alkoba.sandoval13@gmail.com.com>
 * @license  proprietary software
 * @since    1.0.0
 */

use Illuminate\Support\Arr;

/**
 * Method resp
 *
 * Formate response Json
 *
 * @author  Angel Sandoval <alkoba.sandoval13@gmail.com.com>
 * @param   $code
 * @param   $message
 * @param   $data
 * @return \Illuminate\Http\Response response
 */

if (! function_exists('resp')) {
    function resp($code, $message, $data = [])
    {
        $code = is_numeric($code) ? $code : (int) Config($code);
        $response = [
            'code' => $code,
            'message' => __($message),
            'data' => $data
        ];
        return response()->json($response, $code);
    }
}

/**
 * Method __c
 *
 * Get constant by path string
 *
 * @author  Angel Sandoval <alkoba.sandoval13@gmail.com.com>
 * @param   $constantString
 * @return Config
 */
if (! function_exists('__c')) {
    function __c($constantString)
    {
        return Config('constants.' . $constantString);
    }
}