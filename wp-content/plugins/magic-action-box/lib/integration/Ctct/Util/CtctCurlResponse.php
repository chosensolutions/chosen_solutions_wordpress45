<?php
/**
 * A CtctCurlResponse object to be returned from a RestClientInterface implementation
 *
 * @package     Util
 * @author      Constant Contact
 */
class CtctCurlResponse
{

    public $body;
    public $error;
    public $info;

    public static function create($body, $info, $error = null)
    {
        $curl = new CtctCurlResponse();

        $curl->body = $body;
        $curl->info = $info;
        $curl->error = $error;

        return $curl;
    }
}
