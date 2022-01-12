<?php

namespace CRUD\Controller;

use CRUD\Model\Actions;
use CRUD\Model\Person;
use CRUD\Helper\PersonHelper;

class PersonController
{
    public function switcher($uri,$request)
    {
		
        switch ($uri)
        {
            case Actions::CREATE:
                $this->createAction($request);
                break;
            case Actions::UPDATE:
                $this->updateAction($request);
                break;
            case Actions::READ:
                $this->readAction($request);
                break;
            case Actions::READ_ALL:
                $this->readAllAction($request);
                break;
            case Actions::DELETE:
                $this->deleteAction($request);
                break;
            default:
                break;
        }
		
    }

    public function createAction($request)
    {
		$personHelper = new PersonHelper();
		$result = $personHelper->fetchAll();
		$flag = false;
		foreach($result as $value ){
		
			if($value["username"] === $request["username"]){
				$flag = true;
				break;
			}
		}
		if($flag){
			echo "username is taken";
		}else{
			if(!is_numeric($request["firstName"]) && !is_numeric($request["lastName"]) && !is_numeric($request["username"])){
				$personHelper = new PersonHelper();
				$user = new Person();
				$user->setFirstName($request["firstName"]);
				$user->setLastName($request["lastName"]);
				$user->setUsername($request["username"]);
				$personHelper->insert($user);		
			}else{
				echo "please enter valid inputs";
			}
		}
    }

    public function updateAction($request)
    {
		if(!is_numeric($request["firstName"]) && !is_numeric($request["lastName"]) && !is_numeric($request["username"])){
			$personHelper = new PersonHelper();
			$personHelper->update($request["firstName"],$request["lastName"],$request["username"]);
		}else{
			echo "please enter valid inputs";
		}
    }

    public function readAction($request)
    {
		if(is_numeric($request["id"]) && !empty($request["id"])){
			$personHelper = new PersonHelper();
			$result = $personHelper->fetch($request["id"]);
			if(isset($result[0]["firstname"])){
				echo "<br/>Name : ". $result[0]["firstname"];
				echo "<br/>Family : ". $result[0]["lastname"];
				echo "<br/>Username : ". $result[0]["username"];
			}else{
				echo "user isn't any user with this id";
			}
		}else{
			echo "please enter valid inputs";
		}
    }
    public function readAllAction($request)
    {
		$personHelper = new PersonHelper();
		$result = $personHelper->fetchAll();
		
		foreach($result as $value ){
			echo "<br/>Name : ". $value["firstname"];
			echo "&emsp;Family : ". $value["lastname"];
			echo "&emsp;Username : ". $value["username"];
		}
    }

    public function deleteAction($request)
    {
		if(!is_numeric($request["username"])){
			$personHelper = new PersonHelper();
			$personHelper->delete($request["username"]);
		}else{
			echo "please enter valid inputs";
		}
    }

}