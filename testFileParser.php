<?php

function parseTestFile($filePath)
{
    $content = file_get_contents($filePath);
    $functionsName = [];
    if (preg_match_all('/function (.*)?/', $content, $match)) {
        $functionsName = $match[1];
    }

    $functionsContent = [];
    foreach ($functionsName as $num => $function) {
        $func = str_replace(["(", ")", "$"], ["\(", "\)", "\\$"], $function);
        $regex = "/function ".$func."[^{]*{\n(((?!(}\n\n.*function)|(}\n}\n$)).|\n)*)?/";
        if (preg_match($regex, $content, $match)) {
            $functionsContent[] = $match[1];
        }
    }

    $functionsHtml = [];
    foreach ($functionsName as $num => $function) {
        /*$functionsHtml[] = '<div class="card" style="text-align: center;margin-top: 20px;">
                <div class="card-header">
                    <input class="form-control" value="function '.$function.'" />
                </div>
            </div>
            <span>{</span>
            <div class="card" style="text-align: center;margin-top: 20px;">
                <div class="card-header">
                    <input class="form-control" value="hidden" />
                </div>
                <div class="card-body">
                    <div id="function'.$num.'" class="editor">'.$functionsContent[$num].'</div>
                    <script>
                        var editor'.$num.' = ace.edit("function'.$num.'");
                    </script>
                </div>
            </div>
            <span>}</span>';*/
    }

    return $functionsHtml;
}
