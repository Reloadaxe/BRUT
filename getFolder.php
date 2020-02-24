<?php

if ($_POST["folderBeginWith"] == "") {
    return;
}

$folders = glob($_POST["folderBeginWith"] . "*", GLOB_ONLYDIR);

echo(implode(", ", $folders));
