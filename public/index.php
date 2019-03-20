<?php


include('translationProcessor.php');
$fileName = 'data.json';

$tranlastionProcessor = new translationProcessor($fileName);

$results = $tranlastionProcessor->translateTextWithTimeCodes();

print_r($results->toJson()); 
die();