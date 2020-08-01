<?php

/**
 * @author McLOVIN [ Matheus Vinicius Gerônimo Falda ]
 * @version 1.0
 *
 */

if (!function_exists('cRedirect')) {
	function cRedirect($location = '', $type = 'c')
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

		return redirect()->to(base_url($group.$location));
	}
}