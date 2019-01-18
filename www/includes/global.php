<?php
require_once($c['dir']['includes'] . 'functions.php');

// Select Language
require_once(GetLang($c));

$c['dir']['template'] = sprintf($c['dir']['template'], $c['template']);
$c['url']['template'] = sprintf($c['url']['template'], $c['template']);

if ($c['debug']) RemoveDirectory(__DIR__ . '/' . $c['dir']['twigCache']);

$c['dirUrl'] = array();
foreach (explode('/', $_SERVER['REQUEST_URI']) as $v) {
    if (trim($v) <> '') {
        $v = urldecode($v);
        $s = trim(implode('/', $c['dirUrl']));
        if (strlen($s) > 0) $s .= '/';
        $s .= $v;
        if (is_dir($s))
            $c['dirUrl'][] .= $v;
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
