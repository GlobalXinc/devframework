<?php
class Home
{
	public static function index()
	{
		echo "This text to first load on homepage site";
	}

	public static function error()
	{
		echo "This text handle error site";
	}

	// sample method on home/about
	public static function about()
	{
		$data = array(
			"title" => "About site"
		);

		ROUTE::view("about", $data);
	}
}