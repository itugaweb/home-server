<div><a href="index.php?a=strongnet.all">All</a></div>
<div><a href="index.php?a=strongnet.debug">Debug</a></div>
<div><a href="index.php?a=strongnet.tools">StrongNet Tools</a></div>
<div><a href="index.php?a=strongnet.g4setup">StrongNet G4Setup</a></div>
<div><a href="index.php?a=strongnet.g4update">StrongNet G4Update</a></div>
<hr />
<?php
if (isset($_GET['a']) and isset($_GET['str']) and $_GET['str'] == 'str') {
    $ftpServer = 'ftp.strongnet.pt';
    $ftpUserName = 'pg29628';
    $ftpPassword = 'wsnnRyo1Xz';
	require_once('config.php');
    
    $ftpDirsStrongNetToolsRemote = '/public_html/000/sub/g4/setup/dll/';
    $ftpDirsStrongNetToolsRemoteDebug = '/public_html/000/sub/g4/setup/debug/dll/';
    $fileStrongNetTools = 'StrongNet.Tools.dll';

    $ftpDirsStrongNetG4SetupRemote = '/public_html/000/sub/g4/setup/';
    $ftpDirsStrongNetG4SetupRemoteDebug = '/public_html/000/sub/g4/setup/debug/';
    $fileStrongNetG4Setup = 'G4Setup.exe';
    $fileStrongNetG4Setup2 = 'Setup.exe';

    $ftpDirsStrongNetG4UpdateRemote = '/public_html/000/sub/g4/upgrade/';
    $ftpDirsStrongNetG4UpdateRemoteDebug = '/public_html/000/sub/g4/upgrade/debug/';
    $fileStrongNetG4Update = 'G4Update.exe';
    $fileStrongNetG4UpdateZip = 'G4update.zip';
    $fileStrongNetG4Update2 = 'Update.exe';

    // set up basic connection
    $con = ftp_connect($ftpServer);

    // login with username and password
    if (ftp_login($con, $ftpUserName, $ftpPassword)) {
        ftp_pasv($con, true);

        /*
        *
        * StrongNet.Tools
        *
        */
        if ($_GET['a'] == 'strongnet.all' or $_GET['a'] == 'strongnet.tools') {
            // upload a file
            upload($con, $ftpDirsStrongNetToolsRemote . $fileStrongNetTools, $ftpDirsStrongNetTools .
                $fileStrongNetTools);
        }

        /*
        *
        * StrongNet.G4Setup
        *
        */
        if ($_GET['a'] == 'strongnet.all' or $_GET['a'] == 'strongnet.g4setup') {
            // upload a file
            upload($con, $ftpDirsStrongNetG4SetupRemote . $fileStrongNetG4Setup, $ftpDirsStrongNetG4Setup .
                $fileStrongNetG4Setup);
            upload($con, $ftpDirsStrongNetG4SetupRemote . $fileStrongNetG4Setup2, $ftpDirsStrongNetG4Setup2 .
                $fileStrongNetG4Setup2);
        }

        /*
        *
        * StrongNet.G4Update
        *
        */
        if ($_GET['a'] == 'strongnet.all' or $_GET['a'] == 'strongnet.g4update') {
            // upload a file
            upload($con, $ftpDirsStrongNetG4UpdateRemote . $fileStrongNetG4Update, $ftpDirsStrongNetG4Update .
                $fileStrongNetG4Update);
            upload($con, $ftpDirsStrongNetG4UpdateRemote . $fileStrongNetG4Update2, $ftpDirsStrongNetG4Update2 .
                $fileStrongNetG4Update2);
            upload($con, $ftpDirsStrongNetG4UpdateRemote . 'g4update/' . $fileStrongNetG4UpdateZip,
                $ftpDirsStrongNetG4Update . $fileStrongNetG4Update);
        }

        /*
        *
        * StrongNet.Debug
        *
        */
        if ($_GET['a'] == 'strongnet.all' or $_GET['a'] == 'strongnet.debug') {
            upload($con, $ftpDirsStrongNetToolsRemoteDebug . $fileStrongNetTools, $ftpDirsStrongNetTools .
                $fileStrongNetTools);
            upload($con, $ftpDirsStrongNetG4SetupRemoteDebug . $fileStrongNetG4Setup, $ftpDirsStrongNetG4Setup .
                $fileStrongNetG4Setup);
            upload($con, $ftpDirsStrongNetG4SetupRemoteDebug . $fileStrongNetG4Setup2, $ftpDirsStrongNetG4Setup2 .
                $fileStrongNetG4Setup2);
            upload($con, $ftpDirsStrongNetG4UpdateRemoteDebug . $fileStrongNetG4Update, $ftpDirsStrongNetG4Update .
                $fileStrongNetG4Update);
            upload($con, $ftpDirsStrongNetG4UpdateRemoteDebug . $fileStrongNetG4Update2, $ftpDirsStrongNetG4Update2 .
                $fileStrongNetG4Update2);
        }
    }
    // close the connection
    ftp_close($con);
}

function upload($con, $fileRemote, $file)
{
    if (ftp_put($con, $fileRemote, $file, FTP_BINARY)) {
        echo "Successfully uploaded $file to $fileRemote<hr>";
    } else {
        echo "There was a problem while uploading $file to $fileRemote<hr>";
    }
}

?>