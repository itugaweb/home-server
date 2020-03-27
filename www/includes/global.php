<?php
require_once($c['dir']['includes'] . 'functions.php');

// Select Language
require_once(GetLang($c));

$c['dir']['template'] = sprintf($c['dir']['template'], $c['template']);
$c['url']['template'] = sprintf($c['url']['template'], $c['template']);

if ($c['debug']) RemoveDirectory(__DIR__ . '/' . $c['dir']['twigCache']);

require_once(formatPath(array($c['dir']['components']), false) . 'component.php');