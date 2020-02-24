<?php

$projectName = $_POST["projectName"];
$fileName = $_POST["fileName"];

$filePath = __DIR__ . "/projects/" . $projectName . "/tests/" . $fileName;

if (file_exists($filePath)) {
    echo("Le fichier existe déjà");
    return;
}

$templateTest = file_get_contents(__DIR__ . "/templates/ExempleTestTemplate.php");

$testContent = str_replace("[?nameOfTest?]", explode(".", $fileName)[0], $templateTest);

file_put_contents($filePath, $testContent);
