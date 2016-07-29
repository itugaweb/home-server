<?php
require_once($c['dirs']['includes'] . 'functions.php');

// Select Language
require_once(GetLang($c));

$c['dirs']['template'] = sprintf($c['dirs']['template'], $c['template']);

if ($c['debug']) RemoveDirectory(__DIR__ . '/' . $c['dirs']['twigCache']);

$c['dir'] = array();
foreach (explode('/', $_SERVER['REQUEST_URI']) as $v) {
    if (trim($v) <> '') {
        $v = urldecode($v);
        $s = trim(implode('/', $c['dir']));
        if (strlen($s) > 0) $s .= '/';
        $s .= $v;
        if (is_dir($s))
            $c['dir'][] .= $v;
    }
}

// Tools
GetContent($c, 'tools');

// Projects
GetContent($c, 'projects');

// Tests
GetContent($c, 'tests');

// Links
GetContent($c, 'links');
