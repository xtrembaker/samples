<?php

$stream = new SplFileObject(__DIR__.'/import.csv');
$stream->setCsvControl(';');
$stream->setFlags(SplFileObject::READ_CSV);


$xmlDocument = <<<XML
<?xml version='1.0'?>
<Workbook/>
XML;

$xml = new SimpleXMLElement($xmlDocument);


foreach(new LimitIterator($stream, 1) as $csvLine){
    $cell = $xml->addChild('cell');
    $cell->addAttribute('key', 'value');
    $sku = $cell->addChild('sku', $csvLine[0]);
}

$xml->saveXML(__DIR__.'/output.xml');