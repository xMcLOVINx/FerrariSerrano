<?php
namespace App\Libraries;

class Date
{
	protected $format = "Y-m-d H:i:s";
	protected $array = false;
	protected $days;

	protected $retriveDiffType;
	protected $aux;

	protected $operation;
	protected $current;
	protected $storage;


	public function __construct($time = 'now')
	{
		$this->current = new \DateTime($time);
	}


	// ==============================

	public function add()
	{
		$this->operation = "add";

		return $this;
	}

	public function sub()
	{
		$this->operation = "sub";

		return $this;
	}

	public function days($days)
	{
		$this->days = $days;

		return $this;
	}

	public function retriveArray()
	{
		$this->array = true;

		return $this;
	}

	// ==============================

	public function diff()
	{
		$this->operation = "diff";

		return $this;
	}

	public function aux($date)
	{
		$this->aux = new \DateTime($date);

		return $this;
	}

	// ==============================

	public function get()
	{
		switch ($this->operation) {
			case 'add':
				return $this->compileAddSub();

			case 'sub':
				return $this->compileAddSub();

			case 'diff':
				return $this->compileDiff();
			
			default:
				throw new \InvalidArgumentException('
					Error, operation not found.
				');
		}
	}

	// ==============================

	private function compileAddSub()
	{
		if ($this->array) {
			$array = [];

			for ($i = 0; $i < $this->days; $i++) {
				$array[] = ($this->current->{$this->operation}(
					new \DateInterval(sprintf('P1D'))
				))->format('Y-m-d H:i:s');
			}

			$this->storage = $array;
		} else {
			$this->storage = $this->current->{$this->operation}(
				new \DateInterval(sprintf('P%dD', $this->days))
			);
		}

		return $this->storage;
	}

	// ==============================

	private function compileDiff()
	{
		if (!is_object($this->aux)) {
			throw new \Exception('Error, auxiliary date not found.');
		}

		return $this->current->diff($this->aux);
	}
}
