<?php
/*require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

$request = $_REQUEST;
$ID = $request['id'];

$application = $crud->SelectJson('ApplicationsView','ID', $ID);

  echo $application;
}*/

//include config file
require_once "../../DB/dbConfig.php";

//a PHP Super Global variable which used to collect data after submitting it from the form
$request = $_REQUEST;
//define the employee ID
$Id = $request['id'];

// Set the INSERT SQL data
$sql = "SELECT * FROM ApplicationsView WHERE ID='".$Id."'";

// Process the query
$results = $db->query($sql);

// Fetch Associative array
$row = $results->fetch_assoc();

// Free result set
$results->free_result();

// Close the connection after using it
$db->close();

// Encode array into json format
echo json_encode($row);
