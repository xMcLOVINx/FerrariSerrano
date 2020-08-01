<?php

/**
 * @author McLOVIN [ Matheus Vinicius Gerônimo Falda ]
 * @version 1.0
 *
 * THE HELPER TEMPLATE WAS BE CREATED TO
 * LOAD NEW VIEW() "INSTANCES", THUS,
 * SIMPLIFYING YOUR USAGE IN A LOT OF
 * SYSTEM PARTITIONS...
 *
 */

if (!function_exists('vClient')) {
	function vClient(string $common, array $data = [])
	{
		$request = \Config\Services::request();

		$data = [
			'common' => 'client/' . $common,
			'data' => array_merge(
				$data, array (
					'segments' => $request->uri->getSegments()
				)
			)
		];

		return view('client/common/common', $data);
	}
}

if (!function_exists('vAdmin')) {
	function vAdmin(string $common, array $data = [])
	{
		$request = \Config\Services::request();

		$data = [
			'common' => 'admin/' . $common,
			'data' => array_merge(
				$data, array (
					'segments' => $request->uri->getSegments()
				)
			)
		];

		return view('admin/common/common', $data);
	}
}