<?php
// Example of compiling a haml tempalte.

    require 'vendor/autoload.php';
    $haml = new MtHaml\Environment('php');
    
    $template = __DIR__ . '/foo.haml';
    $hamlCode = file_get_contents($template);
    
    
    // no need to compile if already compiled and up to date
    if (!file_exists($template.'.php') || filemtime($template.'.php') != filemtime($template)) {

        $phpCode = $haml->compileString($hamlCode, $template);

        $tempnam = tempnam(dirname($template), basename($template));
        file_put_contents($tempnam, $phpCode);
        rename($tempnam, $template.'.php');
        touch($template.'.php', filemtime($template));
    }
        
    echo "\n\nExecuted Template:\n\n";

    extract([
        'foo' => 'bar',
    ]);

    require $template.'.php';

    echo "\n\nRendered Template:\n\n";

    readfile($template.'.php');
    