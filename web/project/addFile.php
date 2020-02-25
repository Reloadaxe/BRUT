<?php

include_once(dirname(__DIR__) . "/useful.php");

$projectName = $_POST["projectName"];
$fileName = $_POST["fileName"];

createTestFile($fileName, $projectName);
