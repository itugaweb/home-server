<?php
function formatPath($params, $fromRoot = true)
{
    static $root = null;
    if ($root === null)
        $root = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;

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

function formatUrl($params, $fromRoot = true)
{
    static $rootUrl = null;
    if ($rootUrl === null) {
        $rootUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];

        $length = strlen($_SERVER['SERVER_PORT']);
        if (substr_compare($rootUrl, $_SERVER['SERVER_PORT'], -$length) === 0) {
            $rootUrl .= '/';
        } else {
            $rootUrl .= (isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT'] != '80' && $_SERVER['SERVER_PORT'] != '443') ? ':' . $_SERVER['SERVER_PORT'] : '') . '/';
        }

        $base = dirname($_SERVER['PHP_SELF']);
        $rootUrl .= ($base != '' && $base != '\\') ? ltrim($base, '/') . '/' : '';
    }

    if (!is_array($params))
        $params = array($params);

    $out = '';
    if ($fromRoot)
        $out .= $rootUrl;

    foreach ($params as $param)
        if ($param != '') {
            $out .= $param . '/';
            if (substr($out, -2) == '//')
                $out = substr($out, 0, -1);
        }
    return $out;
}

$c['mainPage'] = 'home';

$c['company'] = 'CompanyName';
$c['companyLink'] = 'http://www.company.com';
$c['debug'] = false;
$c['dir']['root'] = formatPath('');
$c['dir']['components'] = formatPath('components');
$c['dir']['images'] = formatPath('images');
$c['dir']['includes'] = formatPath('includes');
$c['dir']['language'] = formatPath('language');
$c['dir']['libraries'] = formatPath('libraries');
$c['dir']['composer'] = formatPath(array('libraries', 'composer'));
$c['dir']['templates'] = formatPath('templates');
$c['dir']['template'] = formatPath(array('templates', '%s'));
$c['dir']['temp'] = formatPath('tmp');
$c['dir']['twigTemp'] = formatPath(array('tmp', 'twig'));
$c['dir']['twigCache'] = formatPath(array('tmp', 'twig', 'cache'));
$c['url']['root'] = formatUrl('');
$c['url']['images'] = formatUrl('images');
$c['url']['libraries'] = formatUrl('libraries');
$c['url']['composer'] = formatUrl(array('libraries', 'composer'));
$c['url']['templates'] = formatUrl('templates');
$c['url']['template'] = formatUrl(array('templates', '%s'));
$c['languagegDefault'] = 'pt-PT';
$c['template'] = 'templatename';
$c['year'] = date('Y');