<?php 

/**
* 
*/

require 'db.php';

class Controller 
{
	private function _clearString($str)
	{
		return trim(strip_tags($str));
	}

	public function index()
	{
		if (!isset($_SERVER['PHP_AUTH_USER'])) {
		    header('WWW-Authenticate: Basic realm="Please, sign in"');
		    header('HTTP/1.0 401 Unauthorized');
		    echo 'Authorization required';
		    exit;
		} else {
		    echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
		    echo "<p>You've entered password {$_SERVER['PHP_AUTH_PW']}.</p>";
		}
		header("location: view.php");
	}

	public function init()
	{
		$db = new Db();
		$db->init();
	}

	public function addItem()
	{
		$db = new Db();
		$title = $this->_clearString($_POST['title']);
		$description = $this->_clearString($_POST['description']);
	    
	    $db->add_item($title, $description);
	}

	public function delete()
	{
		$db = new Db();
		$id = abs($_GET['id']);

		$db->delete_by_id($id); 
	}

	public function updateEntry()
	{
		$db = new Db(); 
		$db->update_by_id($_POST['id'], $_POST['description']);
	}

}

// $controller = new Controller;

// if(isset($_GET['action']) && !empty($_GET['action'])){
// 	$controller->{$_GET['action']}();
// }