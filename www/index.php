<?php
if (isset($_GET['phpinfo'])) {
    phpinfo();
    exit();
}

require_once('configdefault.php');
if (file_exists('config.php'))
    require_once('config.php');

require_once $c['dirs']['composer'] . 'autoload.php';
require_once($c['dirs']['includes'] . 'global.php');

$l = new Twig_Loader_Filesystem($c['dirs']['template']);
$t = new Twig_Environment($l, array(
    'cache' => $c['dirs']['twigCache'],
    'debug' => $c['debug']
));

$t->addGlobal('c', $c);

echo $t->render('index.tpl');