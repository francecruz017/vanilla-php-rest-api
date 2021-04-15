<?php

require_once("models/User.php");

class UserController {

	public function getAllUsers()
	{
		$user = new User();
		$result = $user->getAll();

		return json_encode($result);
	}


	public function getUser($id)
	{
		$user = new User();
		$result = $user->find($id);

		return json_encode($result);
	}

	public function createUser()
	{
		$user = new User();
		$checkUsername = $user->checkUsername($_REQUEST['username']);

		if($checkUsername) {
			if($user->store($_REQUEST)) {
				return json_encode(["message" => "success"]);
			}
		} else {
			http_response_code(400);
			return json_encode(["message" => "username must be unique."]);
		}
		
		http_response_code(400);
		return json_encode(["message" => "something went wrong."]);
	}

	public function updateUser($id)
	{
		$user = new User();

		// the only way I know how to get PUT DATA on PHP
		parse_str(file_get_contents("php://input"),$_REQUEST);

		parse_str(file_get_contents("php://input"), $_PUT);

		foreach ($_PUT as $key => $value)
		{
			unset($_PUT[$key]);

			$_PUT[str_replace('amp;', '', $key)] = $value;
		}

		$_REQUEST = array_merge($_REQUEST, $_PUT);
		
		$checkUsername = $user->checkUsername($_REQUEST['username'], $id);

		if($checkUsername) {
			if($user->update($id, $_REQUEST)) {
				return json_encode(["message" => "success"]);
			}
		} else {
			http_response_code(500);
			return json_encode(["message" => "username must be unique."]);
		}

		http_response_code(400);
		return json_encode(["message" => "something went wrong."]);
	}

	public function deleteUser($id)
	{
		$user = new User();

		if($user->destroy($id)) {
			return json_encode(["message" => "success"]);
		}

		http_response_code(400);
		return json_encode(["message" => "something went wrong."]);
	}

	public function checkAuthUser()
	{
		$user = new User();
		$result = $user->checkAuthUser($_REQUEST);

		if(empty($result)) {
			http_response_code(500);
		}

		return json_encode($result);
	}
}