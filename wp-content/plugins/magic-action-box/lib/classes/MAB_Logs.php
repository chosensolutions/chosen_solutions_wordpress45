<?php

class MAB_Logs{
	public static function log($log, $type = 'error'){
    	if(is_array($log)){
    		$log = print_r($log, true);
    	}
    	switch($type){
    		case 'debug':
    		case 'log':
    			if(defined('MAB_DEBUG') && MAB_DEBUG){
    				error_log($log);
    			}
    		break;

    		case 'error':
    		default:
    			error_log($log);
    		break;
    	}
	}
}