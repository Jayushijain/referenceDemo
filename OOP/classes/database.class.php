<?php
class Database
{
	private $_host     = 'localhost';
	private $_username = 'root';
	private $_password = '';
	private $_database = 'corephp';

	protected $connection;
	protected $table;
	protected $order;
	protected $where;

	public function __construct()
	{
		if (!isset($this->connection))
		{
			$this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

			if (!$this->connection)
			{
				echo 'Cannot connect to database server';
				exit;
			}
		}

		return $this->connection;
	}

	public function select()
	{
		$select_sql = "SELECT * FROM $this->table ";
		$select_sql .= ($this->where != '') ? "WHERE $this->where" : '';

		// echo "SQL".$select_sql;
		// exit();
		//echo "ID:".$id;
		$select_result =  $this->connection->query($select_sql);

//echo "result".mysqli_num_rows($select_result);
		if ($select_result->num_rows > 0)
		{
			$record = array();
			while ($row = $select_result->fetch_assoc())
			{
				$record[] = $row;
			}
			return $record;
		}
	}

	public function add($data)
	{
		print_r($data);
		$columns = array_keys($data);
		$columns = implode(',', $columns);

		$values = array_values($data);
		$values = implode("','", $values);
		echo $values;
		$add_sql = "INSERT INTO $this->table ";
		$add_sql .= "($columns) VALUES('$values')";
		echo $values;
		echo $add_sql;



		if ( $this->connection->query($add_sql))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function edit($data)
	{
		$columns = array_keys($data);
		// $columns = implode(",",$columns);

		$values = array_values($data);
		// $values = implode("','",$values);

		$fields = count($columns);

		$sql = "UPDATE $this->table SET";

		for ($i = 0; $i <= $fields - 1; $i++)
		{
			if ($i == $fields - 1)
			{
				$sql .= " $columns[$i]='$values[$i]'";
			}
			else
			{
				$sql .= " $columns[$i]='$values[$i]', ";
			}
		}

		$sql .= " WHERE $this->where";

		if ( $this->connection->query($sql))
		{
			echo $sql;

			return true;
		}
		else
		{
			return false;
		}
	}

	public function delete()
	{
		$delete_sql = "DELETE FROM $this->table ";
		$delete_sql .= "WHERE $this->where";

		if ( $this->connection->query($delete_sql))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function delete_multiple()
	{
		$sql = "DELETE FROM $this->table ";
		$sql .= "WHERE $this->where";
		echo $sql;

		if ( $this->connection->query($sql))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

?>