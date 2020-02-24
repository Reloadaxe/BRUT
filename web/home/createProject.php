<?php

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
mkdir($projectPath . "/web");
file_put_contents($projectPath . "/phpunit.xml", $xml);
