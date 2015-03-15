<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getCurrentDate'))
{
	function getCurrentDate()
	{
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		
		$currentDate = date("Y-m-d H:i:s");
    
    	return $currentDate;
    
	}
}