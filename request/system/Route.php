<?php
class Route
{
	public static function view($filename, $data = "")
	{
		$filename = "./design/" . $filename . ".php";

		if ( !file_exists($filename) ) echo "Page not found! ($filename)";
		else require_once $filename;
	}

	public static function data($file)
	{
		$filename = "./database/" . $file . ".php";

		if (!file_exists($filename)) echo"<br/>ERROR:/ Page not found! ($filename) <br/>";
		else
		{
			require_once $filename;
			return new $file;
		}
	}
}