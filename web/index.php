<?php 

require 'controller.php';

// (new Controller())->index();

$controller = new Controller;

if(isset($_GET['action']) && !empty($_GET['action'])){
	$controller->{$_GET['action']}();
} else {
	$controller->index();
}
