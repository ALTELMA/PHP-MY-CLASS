<?php

class XMLFeed
{
	private $xmlHeader = '<trovit>';
	private $xmlFooter = '</trovit>';
	private $xmlFeedFile = 'trovit_feed.xml';

	public function __construct()
	{
		file_put_contents($this->xmlFeedFile, '');
	}

	public function feed()
	{
		file_put_contents($this->xmlFeedFile, $this->xmlHeader, FILE_APPEND);

		$results = array(
			array('id' => 1, 'name' => uniqid()),
			array('id' => 2, 'name' => uniqid()),
			array('id' => 3, 'name' => uniqid()),
			array('id' => 3, 'name' => uniqid()),
			array('id' => 3, 'name' => uniqid()),
			array('id' => 3, 'name' => uniqid()),
			array('id' => 3, 'name' => uniqid()),
		);

		foreach ($results as $result)
		{
			file_put_contents($this->xmlFeedFile, $this->getXMLData($result), FILE_APPEND);
		}

		file_put_contents($this->xmlFeedFile, $this->xmlFooter, FILE_APPEND);
	}

	private function getXMLData($data)
	{
		$xml = new XMLWriter();
		$xml->openMemory();
		$xml->setIndent(true);
		$xml->writeElement('id', $data['id']);
		$xml->writeElement('name', $data['name']);

		return $xml->flush(true);
	}
}

$xml = new XMLFeed;
$xml->feed();

?>
