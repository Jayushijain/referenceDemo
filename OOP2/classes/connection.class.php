<?php
include_once 'MysqliDb.php';
include_once '../../includes/custom_errorlog.php';

	class Connection extends MysqliDb
	{
		protected $db;
		public function __construct()
		{
			parent::__construct();
			$this->db = new MysqliDb('localhost', 'root', '', 'practise');

			if (!$this->db)
			{
				trigger_error('Failed to connect to database!');
			}
		}
	}

?>