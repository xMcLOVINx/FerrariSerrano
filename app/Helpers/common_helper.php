<?php

/**
 * @author McLOVIN [ Matheus Vinicius Gerônimo Falda ]
 * @version 1.0
 *
 */

if (!function_exists('cleanPrice')) {
	function cleanPrice($value)
	{
		if ($value && $value !== '') {
			return str_replace(',', '', $value);
		}

		return '0';
	}
}

if (!function_exists('convertPrice')) {
	function convertPrice($value)
	{
		return number_format($value, 2, ',', '.');
	}
}

if (!function_exists('convertDate')) {
	function convertDate($date, $reverse = false)
	{
		if ($reverse === true) {
			return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
		}

		return date('d/m/Y', strtotime($date));
	}
}

if (!function_exists('convertImage')) {
	function convertImage($image)
	{
		if (is_dir($image) || is_null($image) || !file_exists($image)) {
			return base_url('uploads/default.png');
		}

		return base_url($image);
	}
}