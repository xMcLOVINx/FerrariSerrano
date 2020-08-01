<?php
namespace App\Models;

class BiTModel extends \CodeIgniter\Model
{
	public function __construct()
	{
		parent::__construct();
	}


	public function add($data = [])
	{
		if ($this->insert($this->cleanData($data))) {
			return $this->insertID();
		}
	}


	public function get($data = [])
	{
		if ($query = $this->getWhere($data)) {
			return $query->getResult();
		}
	}

	public function getLast($data)
	{
		if ($query = $this->getWhere($data)->getLastRow()) {
			return $query;
		}
	}


	public function edit($data, $where)
	{
		if ($this->set($data)->where($where)->update()) {
			return $this->affectedRows();
		}
	}

	public function count($where = [], $retrieveType = 'simple')
	{
		if ($query = $this->select()->where($where)) {
			switch (strtolower($retrieveType)) {
				case 'fullest':
					return [
						'data' => $query->get(),
						'count' => $query->countAllResults()
					];

				default:
					return $this->countAllResults();
			}
		}
	}


	private function cleanData($data)
	{
		foreach ($data as $key => $value) {
			if ($value === '') {
				$data[$key] = null;
			}
		}

		return $data;
	}
}