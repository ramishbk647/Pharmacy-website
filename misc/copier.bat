@echo off

for /f "eol=; delims== tokens=1*" %%a in (config.ini) do (
	if %%a==IPG (
		set ipg=%%b
	) else if %%a==Timeout (
		set delay=%%b
	)
)

if not defined delay set delay=5

for /f "eol=; delims== tokens=1*" %%a in (backup.ini) do (
	echo Copying "%%a" to "%%b"...
	timeout /t %delay% /nobreak
	if defined ipg (
		robocopy "%%a" "%%b" /mir /ipg:%ipg%
	) else (
		robocopy "%%a" "%%b" /mir
	)
)
pause