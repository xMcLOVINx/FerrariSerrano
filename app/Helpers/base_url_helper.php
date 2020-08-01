<?php

/**
 * @author McLOVIN [ Matheus Vinicius Gerônimo Falda ]
 * @version 1.0
 *
 */

if (!function_exists('cBaseURL')) {
	function cBaseURL($location, $type = 'c')
	{
		$group = "";

		switch ($type) {
			case 'a':
				$group = "admin/";
			break;
			
			default:
				$group = "client/";
			break;
		}

		return base_url($group.$location);
	}
}