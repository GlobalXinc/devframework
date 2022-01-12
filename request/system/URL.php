<?php
class URL
{
	public static function clear($url)
	{
		$url = strtolower($url);
		$url = str_replace(" ", "-", $url);
		$url = str_replace("_", "-", $url);
		return $url;
	}
}