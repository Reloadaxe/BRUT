<?php

$projectName = $_POST["projectName"];

$projectPath = dirname(dirname(__DIR__)) . "/projects/$projectName";

$xmlPath = "$projectPath/phpunit.xml";

$webPath = "$projectPath/web";

exec(dirname(dirname(__DIR__)) . "/phpunit --configuration '$xmlPath' --coverage-html '$webPath'");

echo ("/projects/$projectName/web/index.html");
