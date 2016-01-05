<?php 

class Db {

	const DSN = 'mysql:dbname=granat;host=localhost';
	const HOST = 'localhost';
	const DBNAME = 'granat';
	const USER = 'root';
	const PASSWORD = '1';

	public $dbh;
	public $table = 'todo';

	public function __construct()
	{
		try {
			$this->dbh = new PDO(Db::DSN, Db::USER, Db::PASSWORD);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
	}

	public function init()
	{
		$query = "SELECT id, title, description 
				  FROM $this->table 
				  ORDER BY id 
				  DESC";
		
		$data = [];
		if($results = $this->dbh->query($query)){
			$data = $results->fetchAll(PDO::FETCH_ASSOC);	
		}

		echo json_encode($data);

	}

	public function add_item($title, $description)
	{
		$query = "INSERT INTO $this->table VALUES(?, ?, ?)"; 
	    $sth = $this->dbh->prepare($query);  
	    $data = ['', $title, $description];
    	$sth->execute($data); 
        // Возвращаем id во front-end для прикрепления
        // элемента списка на экран
        echo $this->dbh->lastInsertId();
	}

	public function update_by_id($id, $description)
	{
		$query = "UPDATE $this->table
				  SET description = ?
				  WHERE id = ?
				  LIMIT 1";

		$sth = $this->dbh->prepare($query);
		$data = [$description, $id];
		$sth->execute($data);
	}

	public function delete_by_id($id)
	{
		$query = "DELETE FROM $this->table WHERE id = $id";
		$this->dbh->exec($query);
	}
}
?>