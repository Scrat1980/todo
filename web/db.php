<?php 

class Db {

	const DSN = 'mysql:host=localhost;dbname=granat';
	const HOST = 'localhost';
	const DBNAME = 'granat';
	const USER = 'root';
	const PASSWORD = '1';

	public $mysql;

	public function __construct()
	{
		$this->mysql = new mysqli(Db::HOST, Db::USER, Db::PASSWORD, Db::DBNAME) or die('problem');
	}

	public function init()
	{
		$query = "SELECT * FROM todo ORDER BY id desc";
		$results = $this->mysql->query($query);
		$data = [];
		if($results->num_rows){
			while($row = $results->fetch_object()){
				$title = $row->name;
				$description = $row->description;
				$id = $row->id;

				$data[] = [
					'title' => $title, 
					'description' => $description, 
					'id' => $id
				];
			}
		}
		echo json_encode($data);
	}

	public function add_item($title, $description)
	{
		$query = "INSERT INTO todo VALUES('', ?, ?)"; 
	      
	    if($stmt = $this->mysql->prepare($query)) { 
	        $stmt->bind_param('ss', $title, $description); 
	        $stmt->execute(); 
	        // Возвращаем id во front-end для прикрепления
	        // элемента списка на экран
	        echo mysqli_insert_id($this->mysql);
			$stmt->close();
	    } else {
	    	die($this->mysql->error); 
	    }
	}

	public function update_by_id($id, $description)
	{
		$query = "UPDATE todo
				  SET description = ?
				  WHERE id = ?
				  LIMIT 1";

		if($stmt = $this->mysql->prepare($query)){
			$stmt->bind_param('si', $description, $id);
			$stmt->execute();
			$stmt->close();
			// echo $res;
			// return 'updated successfully';
		}
	}

	public function delete_by_id($id)
	{
		$query = "DELETE FROM todo WHERE id = $id";
		$this->mysql->query($query) or die('problem deleting from the db.');
	}
}
?>