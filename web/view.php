<!DOCTYPE html > 
<html> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>My To-Do List</title> 
	<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
	<script type="text/javascript" src="js/scripts.js"></script> 
	<!--<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script> 
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> 
	<script type="text/javascript" src="bootstrap/js/npm.js"></script> 
	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap-theme.css"> -->
	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css">
</head> 
 
<body>

	<div id="container" class="container panel panel-default" style="width:300px; margin-top: 30px;"> 
		<div class="panel-body">
			<h1>My to-Do List</h1> 
			 
			<ul id="tabs" class="nav nav-tabs" style="margin-bottom: 5px;"> 
				<li id="todo_tab" class="active">
					<a data-toggle="tab" href="#">To-Do</a>
				</li>
				<li id="newitem_tab">
					<a href="#">New Item</a>
				</li>		 
			</ul> 
			 
			<div id="main" class="tab-content"> 
				 <!-- Список дел -->
				<div id="todo" class="tab-pane fade in active">
					
				</div> 
				 
				<div id="addNewEntry" class="tab-pane fade in">
					<div class="panel panel-primary"> 
						<?php //require '_newEntry.php' ?>

						<div class="panel-heading">
						    Add New Entry
						</div>
						<div class="panel-body">
						    <form id="add"  method="post"> 
						        <p> 
						            <label for="title"> Title</label><br> 
						            <input type="text" name="title" id="title" class="input"/> 
						        </p> 
						      
						        <p> 
						            <label for="description"> Description</label> 
						            <textarea name="description" id="description" rows="5" cols="23"></textarea> 
						        </p>   
						          
						        <p> 
						            <input type="submit" name="addEntry" id="addEntry" value="Add New Entry" class="btn btn-primary"/> 
						        </p> 
						    </form> 
						</div> 
						</div>
				</div> 
			 
			</div> 
		</div>
	</div> 
 
</body> 
</html>