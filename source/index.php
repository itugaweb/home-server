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
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$languages[$ln]['c1']}">
<head>
	<title>{$languages[$ln]['title']}</title>
	<meta http-equiv="Content-Type" content="txt/html; charset=utf-8" />
	<link rel="shortcut icon" href="images/favicon.ico" type="image/ico" />
	<link href="css/main.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="index">
	<div id="head">
		<a href="http://{$_SERVER['SERVER_NAME']}/"><img src="images/logo.png" alt="iTuga Web" /></a>
		<ul class="lang">
			<li><a href="?l=en_US"><img src="images/flags/us.png" alt="gb.png" title="{$languages[$ln]['us']}" width="16" height="16" /></a></li>
			<li><a href="?l=pt_PT"><img src="images/flags/pt.png" alt="pt.png" title="{$languages[$ln]['pt']}" width="16" height="16" /></a></li>
		</ul>
	</div>
	<table width="800" border="0">
	<tr>
		<td valign="top" style="width:200px;">
			<h2>{$languages[$ln]['tools']}</h2>
			<ul class="tools">
				$toolsContents
			</ul>
		</td>
		<td valign="top" style="width:200px;">
			<h2>{$languages[$ln]['projets']}</h2>
			$projectsContents
		</td>
		<td valign="top" style="width:200px;">
			<h2>{$languages[$ln]['tests']}</h2>
			$testsContents
		</td>
		<td valign="top" style="width:200px;">
			<h2>Links</h2>
			<ul class="links">
				<li><a href="http://www.ituga.net" target="_blank">iTuga Web (net)</a></li>
				<li><a href="http://www.ituga.pt" target="_blank">iTuga Web (pt)</a></li>
			</ul>
		</td>
	</tr>
	</table>
	<ul id="foot">
		<li><a href="http://www.ituga.net" target="_blank">ituga.net</a></li>
		<li><a href="http://www.ituga.pt" target="_blank">ituga.pt</a></li>
	</ul>
</div>
</body>
</html>
EOPAGE;

echo $pageContents;
