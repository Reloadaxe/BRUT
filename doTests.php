<?php

$projectName = $_POST["projectName"];

$projectPath = __DIR__ . "/projects/$projectName";

$xmlPath = "$projectPath/phpunit.xml";

$webPath = "$projectPath/web";

exec(__DIR__ . "/phpunit --configuration '$xmlPath' --coverage-html '$webPath'");

echo ("/projects/$projectName/web/index.html");
