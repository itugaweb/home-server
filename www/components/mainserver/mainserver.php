<?php
function GetContent(&$c, $n)
{
    $c[$n]['name'] = $n;

    // Get all?
    $c[$n]['all'] = 0;
    if (isset($_GET[$n])) {
        setcookie('iweb-' . $n, $_GET[$n], time() + 3600);
        $c[$n]['all'] = $_GET[$n];
    } elseif (isset($_COOKIE['iweb-' . $n])) {
        $c[$n]['all'] = $_COOKIE['iweb-' . $n];
    }

    // Html Collapse
    $cv = '0';
    $cn = '(-)';
    if ($c[$n]['all'] <> 1) {
        $cv = '1';
        $cn = '(+)';
    }

    $c[$n]['collapse'] = '<a class="small" href="?' . $n . '=' . $cv . '">' . $cn . '</a>';

    $c[$n]['content'] = '';

    $dir = '';
    $a = $c['dirUrl'];
    $a[0] = '_' . $n;

    $icon = '';
    if ($n == 'tools') {
        $icon = '<i class="fas fa-wrench"></i> ';
    } elseif ($n == 'projects') {
        $icon = '<i class="fas fa-star"></i> ';
    } elseif ($n == 'tests') {
        $icon = '<i class="fas fa-exclamation-triangle"></i> ';
    } elseif ($n == 'links') {
        $icon = '<i class="fas fa-link"></i> ';
    }

    foreach ($a as $v) {
        $dir .= $v . '/';

        // Get in _info.xml
        $file = $dir . '_info.xml';

        if (file_exists($file)) {
            $info = simplexml_load_file($file);
            foreach ($info->add as $add) {
                if ($c[$n]['all'] OR !$add->hide) {
                    $c[$n]['content'] .= '<li class="list-group-item"><a href="' . $add->link . '" target="_blank">' . $icon . $add->name . '</a></li>';
                }
            }
        }
    }

    if (is_dir($dir)) {
        $handle = opendir($dir);
        while ($folder = readdir($handle))
            getNameHide($c, $n, $dir, $folder, $icon);
        closedir($handle);
    }

    return $c;
}

function getNameHide(&$c, $n, $d, $f, $icon)
{
    // Dir to ignore
    $ignoreList = array('.', '..');
    $dir = $d . $f . '/';
    $file = $dir . '_info.xml';

    if (!in_array($f, $ignoreList) && is_dir($dir)) {
        $t = false;
        if (file_exists($file)) {
            $info = simplexml_load_file($file);
            $f = $info->name;
            $t = (strtoupper(trim($info->hide)) == "TRUE" || trim($info->hide) == "1") ? true : false;
        }

        $target = '"';
        if (file_exists($dir . 'index.php') || file_exists($dir . 'index.html')) {
            $target .= ' target="_blank"';
        }

        $olink = '';
        if (!empty($info->link)) {
            $olink = ' <a href="' . $info->link . '" target="_blank"><i class="fas fa-external-link-alt"></i></a>';
        }
        if ($c[$n]['all'] OR !$t) {
            $c[$n]['content'] .= '<li class="list-group-item"><a href="/' . $dir . $target . ' >' . $icon . $f . '</a>' . $olink . '</li> ';
        }
    }
}

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

$t->addGlobal('c', $c);
$c['component'] = $t->render('index.tpl');
