<?php
$file = formatPath(array($c['dir']['components'], $c['mainPage']), false) . $c['mainPage'] . '.php';
$tpl = formatPath(array($c['dir']['components'], $c['mainPage'], 'templates'), false);
if (isset($_GET['page'])) {
    $cFile = formatPath(array($c['dir']['components'], $_GET['page']), false) . $_GET['page'] . '.php';
    $cTpl = formatPath(array($c['dir']['components'], $c['mainPage'], 'templates'), false);

    if (file_exists($cFile))
    {
        $file = $cFile;
        $tpl = $cTpl;
    }

}

$l = new Twig\Loader\FilesystemLoader($tpl);
$t = new Twig\Environment($l, array(
    'cache' => $c['dir']['twigCache'],
    'debug' => $c['debug']
));
$t->addGlobal('c', $c);

require_once($file);