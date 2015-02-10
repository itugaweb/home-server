SET /P copydir=Enter Path:
mklink /d %copydir% "%~dp0www"
PAUSE