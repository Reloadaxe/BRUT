<?php

function createTestFile($fileName, $projectName)
{
    $filePath = dirname(__DIR__) . "/projects/" . $projectName . "/tests/" . $fileName;

    if (file_exists($filePath)) {
        echo("Le fichier existe déjà");
        return;
    }

    $templateTest = file_get_contents(dirname(__DIR__) . "/templates/ExempleTestTemplate.php");

    $testContent = str_replace("[?nameOfTest?]", explode(".", $fileName)[0], $templateTest);

    file_put_contents($filePath, $testContent);
}

function getPathOfFileToTest($testFilePath)
{
    $testFileName = basename($testFilePath);
    $name = substr($testFileName, 0, strlen($testFileName) - strlen("Test.php"));
    $xmlContent = simplexml_load_file(dirname(dirname($testFilePath)) . "/phpunit.xml");
    return $xmlContent->filter->whitelist->directory . "/$name.php";
}
