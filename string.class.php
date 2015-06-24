<?php

class String
{

	public function __construct()
	{
    parent::__construct();
	}

	private function KeySubString($string, $start, $end)
	{
		$startTag = strpos($string, $start, 0) + strlen($start);
		$endTag = strpos($string, $end, $startTag);
		$substr = substr($string, $startTag, ( $endTag - $startTag ));
	  
		return $substr;
	}
	
	private function removeHtmlEntity($string)
	{
	  return preg_replace("/&#?[a-z0-9]+;/i","", $string);
	}
	
}

?>
