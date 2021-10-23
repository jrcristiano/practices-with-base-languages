<?php
    $url = $_SERVER['REQUEST_URI'];

    $positionBar = strrpos($url, '/');
    
    $explodePath = explode('/', $url);
    $explodePath[1] = $explodePath[1] ?? null;
    $explodePath[2] = $explodePath[2] ?? null;

    if ($positionBar !== false && $explodePath[2] != '') {
        $basenameUrl = basename($url);
        $basenameUrl = explode('?', $url);
        $basenameUrl = $basenameUrl[0];

        $file = str_replace("{$basenameUrl}/", $basenameUrl, $basenameUrl);
        $file = __DIR__."/src/pages{$file}.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    $file =  __DIR__."/src/pages{$url}/lista.php";
    if (file_exists($file)) {
        require_once $file;
        return;
    }

    require_once __DIR__ . '/src/pages/not-found.php';
