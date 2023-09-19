<?php

$xmlDocument = <<<XML
<?xml version='1.0'?>
<Workbook/>
XML;

$xml = new SimpleXMLElement($xmlDocument);

// Créez un nouvel élément SimpleXMLElement avec du contenu
$element1 = new SimpleXMLElement('<element1>Contenu de l\'élément 1</element1>');
$xml->addChild('element1', (string)$element1);

// Créez un autre élément SimpleXMLElement avec du contenu
$element2 = new SimpleXMLElement('<element2>Contenu de l\'élément 2</element2>');

// Ajoutez l'élément $element2 comme enfant de $element1
$child = $element1->addChild('element2', (string)$element2);

// Affichez le résultat
$xml->saveXML(__DIR__.'/output.xml');