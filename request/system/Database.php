<?php
class Database
{
	protected $stmt, $con;

	function __construct()
	{
		try
		{
			$this->con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

			if ($this->con->connect_error) throw new Exception("Error Processing Request Connection", 1);
		}

		catch (Exception  $error)
		{
			echo "Error : " . $error->getMessage();
			exit;
		}
	}

	protected function prepare($sql)
	{
		// $this->stmt = $this->con->stmt_init();
		$this->stmt = $this->con->prepare($sql);
	}

	private function clear($data)
	{
		if (is_int($data)) $type = "i";
		else if (is_double($data)) $type = "d";
		else if (is_string($data)) $type = "s";
		else $type = "b";
		
		return $type;
	}

	protected function bind($data)
	{
		if (is_array($data))
		{
			$type = "";
			
			foreach ($data as $clear)
			{
				$type .= $this->clear($clear);
			}

			$this->stmt->bind_param($type, ...$data);
		}

		else
		{
			$this->stmt->bind_param($this->clear($data), $data);
		}
	}

	protected function execute()
	{
		return $this->stmt->execute();
	}

	protected function getResult()
	{
		return $this->stmt->get_result();
	}

	protected function numRows()
	{
		return $this->getResult()->num_rows;
	}

	protected function fetch()
	{
		return $this->getResult()->fetch_assoc();
	}

	protected function fetchAll()
	{
		$getResult = $this->getResult();
		$result = array();
		
		while ($data = $getResult->fetch_assoc())
		{
			array_push($result, $data);
		}

		return $result;
	}
}