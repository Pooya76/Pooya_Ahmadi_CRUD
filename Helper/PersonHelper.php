<?php

namespace CRUD\Helper;

class PersonHelper
{
	

    public function insert($user)
    {
		$db = new DBConnector();
		$db->connect();
		$tableName = $db->getTable();
		$fName = $user->getFirstName();
		$lName = $user->getLastName();
		$usrname = $user->getUsername();
		$qry = "INSERT INTO ".$tableName."(firstname, lastname, username)VALUES ('$fName', '$lName', '$usrname')";
		$db->execQuery($qry); 	
    }

    public function fetch(int $id)
    {
		$db = new DBConnector();
		$db->connect();
		$tableName = $db->getTable();
		$qry = "SELECT * FROM ".$tableName." WHERE id=$id";
		return $db->execGetQuery($qry);
    }

    public function fetchAll()
    {
		$db = new DBConnector();
		$db->connect();
		$tableName = $db->getTable();
		$qry = "SELECT * FROM ".$tableName;
		return $db->execGetQuery($qry);
		
    }

    public function update($fName,$lName,$usrname)
    {
		$db = new DBConnector();
		$db->connect();
		$tableName = $db->getTable();
		$qry = "UPDATE ".$tableName." SET firstname ='$fName', lastname = '$lName' WHERE username = '$usrname'";
		if($db->execQuery($qry)){
			echo "user info updated";
		}else{
			echo "username is invalid";
		}
    }

    public function delete($usrname)
    {
		$db = new DBConnector();
		$db->connect();
		$tableName = $db->getTable();
		$qry = "DELETE FROM ".$tableName." WHERE username= '$usrname'";
		$res = $db->execQuery($qry);
		if($res){
			echo "data deleted successfully";
		}else{
			echo "there isn't any account whith this username";
		}
    }

}