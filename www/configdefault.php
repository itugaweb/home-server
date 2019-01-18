<?php
function formatPath($params, $fromRoot = true)
{
    static $root = null;
    if ($root === null) {
        $root = dirname(__FILE__) . DIRECTORY_SEPARATOR;
    }

    if (!is_array($params))
        $params = array($params);

    $out = '';
    if ($fromRoot)
        $out .= $root;

    foreach ($params as $param)
        if ($param != '') {
            $out .= $param . DIRECTORY_SEPARATOR;
            if (substr($out, -2) == DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR)
                $out = substr($out, 0, -1);
        }

    return $out;
}

$c['company'] = 'CompanyName';
$c['companyLink'] = 'http://www.company.com';
$c['debug'] = false;
$c['dirs']['root'] = formatPath('');
$c['dirs']['images'] = formatPath('images');
$c['dirs']['includes'] = formatPath('includes');
$c['dirs']['language'] = formatPath('language');
$c['dirs']['libraries'] = formatPath('libraries');
$c['dirs']['composer'] = formatPath(array('libraries', 'composer'));
$c['dirs']['templates'] = formatPath('templates');
$c['dirs']['template'] = formatPath(array('templates', '%s'));
$c['dirs']['temp'] = formatPath('tmp');
$c['dirs']['twigTemp'] = formatPath(array('tmp', 'twig'));
$c['dirs']['twigCache'] = formatPath(array('tmp', 'twig', 'cache'));
$c['languagegDefault'] = 'pt-PT';
$c['template'] = 'templatename';
$c['year'] = date('Y');