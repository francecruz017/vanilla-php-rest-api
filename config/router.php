<?php

// if you're looking where to put the routes it is over at ./index.php
// put them in the routes array

function init_routes($routes)
{
	$projectBase = "/apiSample/";

	$uri = $_SERVER['REQUEST_URI'];

	if(substr($uri, -1) !== "/") {
		$uri .= "/";
	}

	// searches for routes [needs improvement when have time]
	foreach ($routes as $key => $route) {
		$url = $route["url"] . "/";
		$url_to_access = $projectBase . $url;

		if(strpos($url, "[param]") !== false) {
			$temp_url = str_replace("[param]/", "", $url);
			$temp_id = str_replace($projectBase . $temp_url, "", $uri);
			$id = (int) (str_replace("/", "", $temp_id));

			$temp_url = str_replace("[param]/", "", $url_to_access);

			$temp_uri = str_replace($id . "/", "", $uri);

			if($temp_uri === $temp_url && $route["type"] === $_SERVER['REQUEST_METHOD']) {
				if($id != 0) {
					echo $routes[$key]["action"]($id);
				} else {
					http_response_code(400);
					echo json_encode(["message" => "needs a parameter to pass"]);
					return;
				}
			}

		} else {
			if($uri === $url_to_access && $route["type"] === $_SERVER['REQUEST_METHOD']) {
				echo $routes[$key]["action"]();
				return;
			}
		}
	}
}