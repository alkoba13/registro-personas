<?php

/**
 * Constants codes to homologate the error codes
 * PHP Version 8.3.6
 *
 * @category constants
 * @package  PERSONS TEST
 * @author    Angel Sandoval <alkoba.sandoval13@gmail.com.com>
 * @license  proprietary software
 * @since    1.0.0
 */

return [
    'EXISTS' => 409,
    'NO_EXISTS' => 202,
    'CONFLICT' => 409, //Este codigo esta repetido por que puede ser usado como conflicto interno
    'WITH_SESSION' => 203,
    'SUCCESS' => 200,
    'BAD_REQ' => 400,
    'UNPROCESSABLE' => 422,
    'NO_FIXERS_AVAILABLE' => 233,
    'EMPTY_BODY' => 204,
    'NOT_FOUND' => 404,
];