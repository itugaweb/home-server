<?php
function getOthers($dir)
{
    try
    {
        $file = $dir . '/_info.xml';
        if (!file_exists($file))
        {
            throw new Exception('File not found!');
        }

        $info = simplexml_load_file($file);
        $contents = '';
        foreach ($info->add as $add)
        {
            $contents .= '<li><a href="' . $add->url . '" target="_blank">' . $add->name . '</a></li>';
        }

        return $contents;
    }
    catch (Exception $e)
    {
        return '';
    }
}

function getName($dir, $folder)
{
    try
    {
        $file = $dir . $folder . '/_info.xml';
        if (!file_exists($file))
        {
            throw new Exception('File not found!');
        }

        $info = simplexml_load_file($file);
        return $info->name;
    }
    catch (Exception $e)
    {
        return $folder;
    }
}

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
        'noProjets' => 'Nenhum projecto.<br />Para criar um novo, crie a directoria em "000/projects".',
        'tests' => 'Testes',
        'noTests' => 'Nenhum teste.<br />Para criar um novo, crie a directoria em "000/tests".'),
    'en_US' => array(
        'lang' => 'English',
        'c1' => 'en',
        'pt' => 'Portuguesse',
        'us' => 'English',
        'company' => 'iTuga Web',
        'title' => 'iTuga Web - Development',
        'tools' => 'Tools',
        'projets' => 'Projects',
        'noProjets' => 'No projects yet.<br />To create a new one, just create a directory in "000/projects".',
        'tests' => 'Tests',
        'noTests' => 'No tests yet.<br />To create a new one, just create a directory in "000/tests".'));

// Select lang
$ln = 'pt_PT';
if (isset($_GET['l']) and $languages[$_GET['l']])
{
    setcookie('iweb-ln', $_GET['l'], time() + 3600);
    $ln = $_GET['l'];
}
elseif (isset($_COOKIE['iweb-ln']))
{
    $ln = $_COOKIE['iweb-ln'];
}

// Show phpinfo
if (isset($_GET['phpinfo']))
{
    phpinfo();
    exit();
}

// Dir to ignore
$ignoreList = array('.', '..');

// Get projects
$dirProjects = 'projects/';
$projectsContents = getOthers($dirProjects);

$handle = opendir($dirProjects);
while ($folder = readdir($handle))
{
    if (is_dir($dirProjects . $folder) && !in_array($folder, $ignoreList))
    {
        $projectsContents .= '<li><a href="' . $dirProjects . $folder . '" target="_blank">' . getName($dirProjects, $folder) . '</a></li>';
    }
}
closedir($handle);

if (!$projectsContents)
{
    $projectsContents = '<p>' . $languages[$ln]['noProjets'] . '</p>';
}
else
{
    $projectsContents = '<ul class="projects">' . $projectsContents . '</ul>';
}

// Get tests
$dirTests = 'tests/';
$testsContents = getOthers($dirTests);

$handle = opendir($dirTests);
while ($folder = readdir($handle))
{
    if (is_dir($dirTests . $folder) && !in_array($folder, $ignoreList))
    {
        $testsContents .= '<li><a href="' . $dirTests . $folder . '" target="_blank">' . getName($dirTests, $folder) . '</a></li>';
    }
}
closedir($handle);
if (!$testsContents)
{
    $testsContents = '<p>' . $languages[$ln]['noTests'] . '</p>';
}
else
{
    $testsContents = '<ul class="projects">' . $testsContents . '</ul>';
}

// Get tools
$dirTools = 'tools/';
$toolsContents = getOthers($dirTools);

$handle = opendir($dirTools);
while ($folder = readdir($handle))
{
    if (is_dir($dirTools . $folder) && !in_array($folder, $ignoreList))
    {
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
    <link rel="icon" href="images/favicon.ico">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
            <h3>{$languages[$ln]['projets']}</h3>
            $projectsContents
        </div>
        <div class="col-sm-6 col-md-3">
            <h3>{$languages[$ln]['tests']}</h3>
            $testsContents
        </div>
        <div class="col-sm-6 col-md-3">
            <h3>Links</h3>
            <ul class="links">
                <li><a href="http://www.ituga.net" target="_blank">iTuga Web
                    (net)</a></li>
                <li><a href="http://www.ituga.pt" target="_blank">iTuga Web (pt)</a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <hr/>
    <div class="footer">
        <ul class="nav nav-pills pull-right">
            <li><a href="http://www.ituga.net" target="_blank">ituga.net</a></li>
            <li><a href="http://www.ituga.pt" target="_blank">ituga.pt</a></li>
        </ul>
        <div class="pull-left">&copy; {$languages[$ln]['company']} 2014
            <div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
EOPAGE;
echo $pageContents;