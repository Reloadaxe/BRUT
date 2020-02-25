<?php

include_once(dirname(__DIR__) . "/useful.php");

$name = $_POST["name"];

$projectPath = dirname(dirname(__DIR__)) . "/projects/" . $name;

if (file_exists($projectPath)) {
    echo "Le nom du projet est déjà existant, Veuillez en choisir un nouveau";
    return;
}

$toTestFolder = $_POST["toTestFolder"];

if (!file_exists($toTestFolder)) {
    echo "Le dossier à tester est inexistant";
    return;
}

$xmlTemplate = file_get_contents(dirname(dirname(__DIR__)) . "/templates/phpunitTemplate.xml");

$xml = str_replace("[?toTestFolder?]", $toTestFolder, $xmlTemplate);
$xml = str_replace("[?testFolder?]", $projectPath, $xml);

mkdir($projectPath);
mkdir($projectPath . "/tests");

foreach (scandir($toTestFolder) as $filename) {
    if ($filename[0] != ".") {
        $leftPart = explode(".", $filename)[0];
        createTestFile($leftPart . "Test.php", $name);
    }
}

mkdir($projectPath . "/web");
file_put_contents($projectPath . "/phpunit.xml", $xml);
