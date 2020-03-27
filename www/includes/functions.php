<?php
function GetLang(&$c, $l = '')
{
    if (empty($l)) $l = $c['languagegDefault'];
    if (isset($_GET['l']) && file_exists($c['dir']['language'] . $_GET['l'] . '.php')) {
        setcookie('iweb-l', $_GET['l'], time() + 3600);
        $l = $_GET['l'];
    } elseif (isset($_COOKIE['iweb-l'])) {
        $l = $_COOKIE['iweb-l'];
    }
    return ($c['dir']['language'] . $l . '.php');
}

function RemoveDirectory($p)
{
    if (!is_dir($p)) return;
    $files = glob($p . '/*');
    foreach ($files as $f) {
        is_dir($f) ? removeDirectory($f) : unlink($f);
    }
    rmdir($p);
}