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
    $cn = '( - )';
    if ($c[$n]['all'] <> 1) {
        $cv = '1';
        $cn = '( + )';
    }

    $c[$n]['collapse'] = '<a class="uk-text-small" href="?' . $n . '=' . $cv . '">' . $cn . '</a>';

    $c[$n]['content'] = '';

    $dir = '';
    $a = $c['dir'];
    $a[0] = '_' . $n;

    $icon = '';
    if ($n == 'tools') {
        $icon = '<i class="uk-icon-wrench"></i> ';
    } elseif ($n == 'projects') {
        $icon = '<i class="uk-icon-star"></i> ';
    } elseif ($n == 'tests') {
        $icon = '<i class="uk-icon-warning"></i> ';
    } elseif ($n == 'links') {
        $icon = '<i class="uk-icon-link"></i> ';
    }

    foreach ($a as $v) {
        $dir .= $v . '/';

        // Get in _info.xml
        $file = $dir . '_info.xml';

        if (file_exists($file)) {
            $info = simplexml_load_file($file);
            foreach ($info->add as $add) {
                if ($c[$n]['all'] OR !$add->hide) {
                    $c[$n]['content'] .= '<li><a href="' . $add->url . '" target="_blank"> ' . $icon . $add->name . '</a></li>';
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

function GetLang(&$c, $l = 'pt-PT')
{
    if (isset($_GET['l']) && file_exists($c['dirs']['language'] . $_GET['l'] . '.php')) {
        setcookie('iweb-l', $_GET['l'], time() + 3600);
        $l = $_GET['l'];
    } elseif (isset($_COOKIE['iweb-l'])) {
        $l = $_COOKIE['iweb-l'];
    }
    return ($c['dirs']['language'] . $l . '.php');
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
            $t = strtoupper(trim($info->hide)) == "TRUE" ? true : false;
        }
        $target = '"';
        if (file_exists($dir . 'index.php') || file_exists($dir . 'index.html')) {
            $target .= ' target="_blank"';
        }

        if ($c[$n]['all'] OR !$t) {
            $c[$n]['content'] .= '<li><a href="/' . $dir . $target . ' >' . $icon . $f . '</a></li> ';
        }
    }

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