<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$username = "root";
$password = "";
$server =  "localhost";
$db_name = "thecoach";
 
/* Attempt to connect to MySQL database */
		try{
				$pdo = new PDO("mysql:host=$server;dbname=$db_name",$username, $password);
				    // Set the PDO error mode to exception
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e){
				die("ERROR: Could not connect. " . $e->getMessage());
		}
?>
