
    setlocal enableextensions disabledelayedexpansion

    set "search=file://E:"
    set "replace=http://192.168.1.9"

    set "textFile=report\movies.html"

    for /f "delims=" %%i in ('type "%textFile%" ^& break ^> "%textFile%" ') do (
        set "line=%%i"
        setlocal enabledelayedexpansion
        set "line=!line:%search%=%replace%!"
        >>"%textFile%" echo(!line!
        endlocal
    )

  pause
