<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response;

/**
 * Create class for return response to api
 *
 */
class ResponseManager
{
    /**
     *
     * Create static variable.
     */
    public static $errorResponse = array();
    public static $successResponse = array();

    /**
     *
     * Method name: errorResponse
     * @param string $message
     * @param integer $code
     * @param array $data
     * @return array
     */
    /**
     * This function will return error response in json format
     *
     * @return array
     */
    public static function errorResponse(string $message, $data = [], int $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        /**
         * This function will return error response
         *
         * @param [string] $message
         * @param [int] $code
         * @param [array] $data
         * @return array
         */
        self::$errorResponse['response']['status'] = false;
        self::$errorResponse['response']['code'] = $code;
        self::$errorResponse['response']['data'] = $data;
        self::$errorResponse['response']['message'] = $message;
        return response()->json(self::$errorResponse, $code);
    }

    /**
     * This function will return success response to user.
     *
     * @return array
     */
    public static function successResponse(string $message, $data = [], int $code = Response::HTTP_OK, $extra_meta = '', $require_data_key = true)
    {
        /**
         * This function will return success json response
         *
         * @param [string] $message
         * @param [int] $code
         * @param [array] $data
         * @return [array]
         */
        if ($require_data_key) {
            self::$successResponse['response']['data'] = $data;
        } else {
            self::$successResponse['response'] = $data;
        }
        self::$successResponse['response']['status'] = true;
        self::$successResponse['response']['code'] = $code;
        self::$successResponse['response']['message'] = $message;
        if ($extra_meta != '') {
            self::$successResponse['response']['extra_meta'] = $extra_meta;
        }
        return response()->json(self::$successResponse, $code);
    }
}
