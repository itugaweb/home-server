<?php
function convertCollapse($value)
{
    $return = '0';
    try {

        if ($value <> 1) {
            $return = '1';
        }

        return $return;
    } catch (Exception $e) {
        return $return;
    }
}

function convertCollapseName($value)
{
    $return = '( - )';
    try {

        if ($value <> 1) {
            $return = '( + )';
        }

        return $return;
    } catch (Exception $e) {
        return $return;
    }
}

function getHide($dir, $folder)
{
    try {
        $file = $dir . $folder . '/_info.xml';
        if (!file_exists($file)) {
            throw new Exception('File not found!');
        }

        $info = simplexml_load_file($file);
        return strtoupper(trim($info->hide)) == "TRUE" ? true : false;
    } catch (Exception $e) {
        return false;
    }
}

function getName($dir, $folder)
{
    try {
        $file = $dir . $folder . '/_info.xml';
        if (!file_exists($file)) {
            throw new Exception('File not found!');
        }

        $info = simplexml_load_file($file);
        return $info->name;
    } catch (Exception $e) {
        return $folder;
    }
}

function getOthers($dir, $force = false)
{
    try {
        $file = $dir . '_info.xml';
        if (!file_exists($file)) {
            throw new Exception('File not found!');
        }

        $info = simplexml_load_file($file);
        $contents = '';
        foreach ($info->add as $add) {
            if ($force OR !$add->hide) {
                $contents .= '<li><a href="' . $add->url . '" target="_blank">' . $add->name . '</a></li>';
            }
        }

        return $contents;
    } catch (Exception $e) {
        return '';
    }
}

// Show phpinfo
if (isset($_GET['phpinfo'])) {
    phpinfo();
    exit();
}

// Year
$year = date('Y');

// Language
$languages = array(
    'pt_PT' => array(
        'lang' => 'Português',
        'c1' => 'pt',
        'pt' => 'Português',
        'us' => 'Inglês',
        'company' => 'iTuga Web',
        'title' => 'iTuga Web - Desenvolvimento',
        'tools' => 'Ferramentas',
        'projets' => 'Projectos',
        'noProjets' => 'Nenhum projecto.<br />Para criar um novo, crie a directoria em "projects".',
        'tests' => 'Testes',
        'noTests' => 'Nenhum teste.<br />Para criar um novo, crie a directoria em "tests".'),
    'en_US' => array(
        'lang' => 'English',
        'c1' => 'en',
        'pt' => 'Portuguesse',
        'us' => 'English',
        'company' => 'iTuga Web',
        'title' => 'iTuga Web - Development',
        'tools' => 'Tools',
        'projets' => 'Projects',
        'noProjets' => 'No projects yet.<br />To create a new one, just create a directory in "projects".',
        'tests' => 'Tests',
        'noTests' => 'No tests yet.<br />To create a new one, just create a directory in "tests".'));

// Select lang
$ln = 'pt_PT';
if (isset($_GET['l']) && $languages[$_GET['l']]) {
    setcookie('iweb-ln', $_GET['l'], time() + 3600);
    $ln = $_GET['l'];
} elseif (isset($_COOKIE['iweb-ln'])) {
    $ln = $_COOKIE['iweb-ln'];
}

// All projects
$allP = false;
if (isset($_GET['allprojects'])) {
    setcookie('iweb-allprojects', $_GET['allprojects'], time() + 3600);
    $allP = $_GET['allprojects'];
} elseif (isset($_COOKIE['iweb-allprojects'])) {
    $allP = $_COOKIE['iweb-allprojects'];
}

$allPColapse = '<small><a href="?allprojects=' . convertCollapse($allP) . '">' . convertCollapseName($allP) . '</a></small>';

// All tests
$allT = false;
if (isset($_GET['alltests'])) {
    setcookie('iweb-alltests', $_GET['alltests'], time() + 3600);
    $allT = $_GET['alltests'];
} elseif (isset($_COOKIE['iweb-alltests'])) {
    $allT = $_COOKIE['iweb-alltests'];
}

$allTColapse = '<small><a href="?alltests=' . convertCollapse($allT) . '">' . convertCollapseName($allT) . '</a></small>';

// Dir to ignore
$ignoreList = array('.', '..');

// Get projects
$dirProjects = 'projects/';
$projectsContents = getOthers($dirProjects, $allP);

$handle = opendir($dirProjects);
while ($folder = readdir($handle)) {
    if (!in_array($folder, $ignoreList) && is_dir($dirProjects . $folder)) {
        if ($allP OR !getHide($dirProjects, $folder)) {
            $projectsContents .= '<li><a href="' . $dirProjects . $folder . '" target="_blank">' . getName($dirProjects, $folder) . '</a></li>';
        }
    }
}
closedir($handle);

if (!$projectsContents) {
    $projectsContents = '<p>' . $languages[$ln]['noProjets'] . '</p>';
} else {
    $projectsContents = '<ul class="projects">' . $projectsContents . '</ul>';
}

// Get tests
$dirTests = 'tests/';
$testsContents = getOthers($dirTests, $allT);

$handle = opendir($dirTests);
while ($folder = readdir($handle)) {
    if (!in_array($folder, $ignoreList) && is_dir($dirTests . $folder)) {
        if ($allT == true OR getHide($dirTests, $folder) == false) {
            $testsContents .= '<li><a href="' . $dirTests . $folder . '" target="_blank">' . getName($dirTests, $folder) . '</a></li>';
        }
    }
}
closedir($handle);
if (!$testsContents) {
    $testsContents = '<p>' . $languages[$ln]['noTests'] . '</p>';
} else {
    $testsContents = '<ul class="projects">' . $testsContents . '</ul>';
}

// Get tools
$dirTools = 'tools/';
$toolsContents = getOthers($dirTools);

$handle = opendir($dirTools);
while ($folder = readdir($handle)) {
    if (!in_array($folder, $ignoreList) && is_dir($dirTools . $folder)) {
        $toolsContents .= '<li><a href="' . $dirTools . $folder . '" target="_blank">' . getName($dirTools, $folder) . '</a></li>';
    }
}
closedir($handle);

$pageContents = <<< EOPAGE
<!DOCTYPE html>
<html lang="{$languages[$ln]['c1']}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{$languages[$ln]['title']}</title>
    <link rel="icon" href="favicon.ico">

    <!-- Bootstrap's core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <!-- Custom styles for this template -->
    <link href="css/template.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <div class="header">
            <ul class="nav nav-pills pull-right">
                <li><a href="?l=en_US"><img src="images/flags/us.png" alt="gb.png"
                                            title="{$languages[$ln]['us']}" width="16"
                                            height="16"/></a></li>
                <li><a href="?l=pt_PT"><img src="images/flags/pt.png" alt="pt.png"
                                            title="{$languages[$ln]['pt']}" width="16"
                                            height="16"/></a></li>
            </ul>
            <a href="http://{$_SERVER['SERVER_NAME']}/"><img
                    src="images/logo.png" alt="iTuga Web"/></a>
        </div>
        <hr/>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <h3>{$languages[$ln]['tools']}</h3>
                <ul class="tools">
                    $toolsContents
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
                <h3>{$languages[$ln]['projets']} {$allPColapse}</h3>
                $projectsContents
            </div>
            <div class="col-sm-6 col-md-3">
                <h3>{$languages[$ln]['tests']} {$allTColapse}</h3>
                $testsContents
            </div>
            <div class="col-sm-6 col-md-3">
                <h3>Links</h3>
                <ul class="links">
                    <li><a href="http://www.ituga.net" target="_blank">iTuga Web</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <hr/>
        <div class="footer">
            <ul class="nav nav-pills pull-right">
                <li><a href="http://www.ituga.net" target="_blank">ituga.net</a></li>
            </ul>
            <div class="pull-left">&copy; {$languages[$ln]['company']} {$year}</div>
        </div>
    </div>
    <!-- jQuery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Bootstrap's core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </body>
</html>
EOPAGE;
echo $pageContents;