<?php

namespace CRUD\Helper;
use \PDO;

class DBConnector
{	
	private $username ;
	private $password;
	private $servername;
	
	private $table = "Person";
	private	$db_name = "crudDb";
	


    /** @var mixed $db */
    private $db;

    public function __construct($servername = "localhost",$username = "root", $password = "")
    {
		$this->servername = $servername;
		$this->username = $username;
		$this->password = $password;
    }

    /**
     * @throws \Exception
     * @return void
     */
    public function connect() : void
    {
		try {
			$this->db = new PDO("mysql:host=".$this->servername, $this->username, $this->password);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  
			  
			$this->db-> query("CREATE DATABASE IF NOT EXISTS ". $this->db_name);
			$this->db-> query("use ". $this->db_name);
			  
			// just to check if table exist, if not, create it  
			try{
				$sh = $this->db->prepare( "DESCRIBE ".$this->table);
				$sh->execute();
			}catch(\Exception $e){	
				$createTabel = "CREATE TABLE ".$this->table."(
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				firstname VARCHAR(30) NOT NULL,
				lastname VARCHAR(30) NOT NULL,
				username VARCHAR(50)
				)";
				$this->execQuery($createTabel);
			}	
				
		} catch(PDOException $e) {
			  exceptionHandler($e->getMessage());
		}
    }

    /**
     * @param string $query
     * @return bool
     */
    public function execQuery(string $query) : bool
    {
        return $this->db->exec($query);
    }
	
	public function execGetQuery(string $query) 
    {
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
        return $result;
    }

    /**
     * @param string $message
     * @throws \Exception
     * @return void
     */
    private function exceptionHandler(string $message): void
    {
		echo $message;
    }
	
	public function getTable()
    {
		return $this->table;
    }

}