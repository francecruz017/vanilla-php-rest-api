<?php

require_once("config/Database.php");

class User {
	private $conn;
	private $table = "users";
	protected $date_now = "";

	public function __construct()
	{
		$database = new Database();
		$this->conn = $database->connect();
		$this->date_now = date('Y-m-d H:i:s');
    }

	public function getAll()
	{
		$data = array();

		$query = "SELECT * FROM {$this->table}";
      	$result = $this->conn->prepare($query);
      	$result->execute();

		$num = $result->rowCount();
		
		if ($num > 0) {
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				extract($row);

				$item = array(
					"id" => $id,
					"firstname"  => $firstname,
					"lastname"   => $lastname,
					"username"   => $username,
					"password"   => $password,
					"created_at" => $created_at,
					"updated_at" => $updated_at
				);

				array_push($data, $item);
			}
		}

      	return $data;
	}


	public function find($id)
	{
		$data = array();

		$query = "SELECT * FROM {$this->table} WHERE id={$id} LIMIT 1";
      	$result = $this->conn->prepare($query);
      	$result->execute();

		$num = $result->rowCount();
		
		if ($num > 0) {
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				extract($row);

				$item = array(
					"id" => $id,
					"firstname"  => $firstname,
					"lastname"   => $lastname,
					"username"   => $username,
					"password"   => $password,
					"created_at" => $created_at,
					"updated_at" => $updated_at
				);

				$data = $item;
			}
		}

      	return $data;
	}

	// put id when using on update. so it doesnt check itself.
	public function checkUsername($username, $id = null)
	{
		$query = "SELECT `id` FROM {$this->table} WHERE username='{$username}' ";

		if ($id !== null) {
			$query .= "AND id != {$id} ";
		}

		$query .= "LIMIT 1";

      	$result = $this->conn->prepare($query);
      	$result->execute();

      	$num = $result->rowCount();

      	return $num == 0;
	}

	public function store($request)
	{
		$data = array();

		$query =
			"INSERT  INTO {$this->table} (`firstname`, `lastname`, `username`, `password`, `created_at`, `updated_at`)
			VALUES ('". $request['firstname'] ."','". $request['lastname'] ."','". $request['username'] ."', '". sha1($request['password']) ."', '". $this->date_now ."', '". $this->date_now ."');";
      	$result = $this->conn->prepare($query);
      	
      	return $result->execute();
	}

	public function update($id, $request)
	{
		$data = array();

		$query =
			"UPDATE {$this->table} SET `firstname`='". $request['username'] ."', `lastname`='". $request['lastname'] ."', `username`='". $request['username'] ."', `password`='". sha1($request['password']) ."', `updated_at`='". $this->date_now ."' WHERE id={$id}";

      	$result = $this->conn->prepare($query);
      	
      	return $result->execute();
	}

	public function destroy($id)
	{
		$data = array();

		$query =
			"DELETE FROM {$this->table} WHERE id={$id}";

      	$result = $this->conn->prepare($query);
      	
      	return $result->execute();
	}

	public function checkAuthUser($request)
	{
		$data = array();

		$query = "SELECT * FROM {$this->table} WHERE username='". $request['username'] ."' AND password='". sha1($request['password']) ."' LIMIT 1";
      	$result = $this->conn->prepare($query);
      	$result->execute();

		$num = $result->rowCount();
		
		if ($num > 0) {
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				extract($row);

				$item = array(
					"id" => $id,
					"firstname"  => $firstname,
					"lastname"   => $lastname,
					"username"   => $username,
					"created_at" => $created_at,
					"updated_at" => $updated_at
				);

				$data = $item;
			}
		}

      	return $data;
	}
}