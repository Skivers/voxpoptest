<?php


include('translationProcessor.php');
$readFileName = 'data.json';
$writeFileName = 'translation.json';

echo "<h2>Reading from file {$readFileName}</h2> <br/> </br>";

$tranlastionProcessor = new translationProcessor($readFileName);

$results = $tranlastionProcessor->translateTextWithTimeCodes();


echo "<h2>Writing to file <a href='{$writeFileName}'>{$writeFileName}</a> </h2><br/><br/>";
$file = fopen($writeFileName, "w") or die("Unable to open file! please make sure file {$writeFileName} exists");
fwrite($file,$results->toJson());
fclose($file);
?>

<h3>toJson();</h3>
<pre>

<?php print_r( $results->toJson());?>

</pre>



<h3>toArray();</h3>

<pre>

<?php print_r( $results->toArray());?>

</pre>


<style>
pre {
    background: #f4f4f4;
    border: 1px solid #ddd;
    border-left: 3px solid #f36d33;
    color: #666;
    page-break-inside: avoid;
    font-family: monospace;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 1.6em;
    max-width: 100%;
    overflow: auto;
    padding: 1em 1.5em;
    display: block;
    word-wrap: break-word;
}
</style>


