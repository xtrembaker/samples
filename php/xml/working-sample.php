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
    $cell = new SimpleXMLElement('<cell>'.$csvLine[0].'</cell>');
    $cell->addAttribute('toto', 'toto');
//    $cell->addChild('Sku', $csvLine[0]);

    $xml->addChild('Cell', (string)$cell);
}

$xml->saveXML(__DIR__.'/output.xml');