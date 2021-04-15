<?php

require_once("models/User.php");
require_once("controller/UserController.php");
require_once("config/router.php");

header("Access-Controll-Allow-Origin: *");
header("Content-Type: application/json");

$routes = [
	[
		"url" => "users",
		"type" => "GET",
		"action" => "UserController::getAllUsers"
	],
	[
		"url" => "users/[param]",
		"type" => "GET",
		"action" => "UserController::getUser"
	],

	[
		"url" => "users",
		"type" => "POST",
		"action" => "UserController::createUser"
	],
	[
		"url" => "users/[param]",
		"type" => "PUT",
		"action" => "UserController::updateUser"
	],
	[
		"url" => "users/[param]",
		"type" => "DELETE",
		"action" => "UserController::deleteUser"
	],
	[
		"url" => "login",
		"type" => "POST",
		"action" => "UserController::checkAuthUser"
	],
];

init_routes($routes);