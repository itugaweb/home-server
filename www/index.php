<?php
if (isset($_GET['phpinfo'])) {
    phpinfo();
    exit();
}

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'config.php');
if (file_exists('config.php'))
    require_once('config.php');

require_once($c['dir']['composer'] . 'autoload.php');
require_once($c['dir']['includes'] . 'global.php');

$l = new Twig\Loader\FilesystemLoader($c['dir']['template']);
$t = new Twig\Environment($l, array(
    'cache' => $c['dir']['twigCache'],
    'debug' => $c['debug']
));

$t->addGlobal('c', $c);

echo $t->render('index.tpl');