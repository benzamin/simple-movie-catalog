# simple-movie-catalog
IMDB style catalog for your personal DVD/Downloaded movies stored a hard-drive directory. Done for personal need, should work out of the box but a hacky mind can always be helpful. Forked from: http://smoviecat.sourceforge.net/

##Usage(Mac/UNIX):
- Edit the 'config.txt' file to add the movie folder link(s). Its better to have the movie folder names 'Moviename (year)' format, like 'Minions (2015)', 'Gone Girl (2014)' etc.
- Double click 'make-catalog', may take some time depending on how much movies in the folder. 
- Once done, open report/movies.html for catalogged movies, and report/movies_missing_info.html for missing movie(s) info.
- If you want to delete current catalog, double click 'reset-as-fresh', then run 'make-catalog'.
- Open the report/Movies.html. For missing movies, check report/movies_missing_info.html.
- If you wish to replace some fixed text inside a file, say movies.html, use the 'find-N-replace' script. Open it with a text editor and edit the values FIND_TEXT, REPLACE_TEXT and FILE_NAME. Then save and double click. Can be used to change the file references as web links.
- If the script fails to find some movie, put the imdb link in a 'info.txt' file inside the movie folder.
- Optional: For the movie-request feature, you need to install a php-mysql system, like XAMPP or Apache. Keep the whole project in the 'htdocs' folder of XAMPP or Apache. Make a new DataBase from mysql control panel(normally http://localhost/phpMyAdmin) and create a 'requests' table in it using movierequest/SQL/db.sql file. Then add your database name/username/password/host in the dbConfig.php file. Now you should be able to run the movierequest/index.php file and add new movie request from the button in the left.

##Usage(Windows)
- Install perl and add it as an "Environment variable" in your windows.
- Edit 'config.txt' and add movie folder paths (like E:\Movies). Its better to have a movie folder names in this format " Moviename (year)", like 'Minions (2015)', 'Gone Girl (2014)' etc.
- run make-catalog.bat, may take some time based on how much movies in the folder.
- Once the black CMD window is done, waiting for some keypress, do it! Open the report/Movies.html for detailed catalog. For missing movies, check report/movies_missing_info.html.
- If you want to replace anything in the report/movies.html, edit the 'find-N-replace.bat' and edit the 'search' and 'replace' variables.
- You can reset all the catalog for a fresh start by double clicking the 'reset-as-fresh.bat'
- Optional: For the movie-request feature, you need to install a php-mysql system, like MAMP. Keep the whole project in the 'htdocs' folder of MAMP. Make a new DataBase from mysql control panel(normally http://localhost/phpMyAdmin) and create a 'requests' table in it using movierequest/SQL/db.sql file. Then add your database name/username/password/host in the dbConfig.php file. Now you should be able to run the movierequest/index.php file and add new movie request from the button in the left.

##Fixes and new features over the original
- Added searching for movies based on Name/Plot/Year/Genre.
- Fixed pulling imdb image failed and year/rating/runtime range search.
- Added executables 'make-catalog' for start making catalog and 'reset-as-fresh' to remove existing catalog for starting fresh.
- Made 'find-N-replace' executable for changing a specific text/link so that it can be configured for Local server/web-server as well.
- Made executables for Windows as well.
- Added optional 'Request movie' feature.


# ORIGINAL readme.txt

Simple Movie Catalog 2.0.0
Copyright (C) 2008-2015 damien.langg@gmail.com

Simple Movie Catalog will scan a given directory for movies,
query imdb for info and generate a catalog in html which offers
sorting and grouping of found movies by different criteria.

Contents:
=========

 - Install
 - Usage
 - Command Line Options
 - Config File
 - Interactive Mode
 - The Catalog Page



Install:
========

* Windows:

   1. Install Perl
      Simple Movie Catalog is written in perl so you'll have to install it first.
      Download from: http://www.activestate.com/Products/activeperl/
      or from: http://strawberryperl.com/
      or install cygwin, which includes perl (http://www.cygwin.com/)
      Make sure to have perl in PATH!

   2. Install Simple Movie Catalog
      Download SimpleMovieCatalog.zip and unpack to a directory of your liking.
      (example: C:\Program Files\SimpleMovieCatalog)

   3. Run
      Drag&drop a directory to run_scan.cmd or edit config.txt and start run_scan.cmd
      The directory will be scanned, html report generated and opened using your
      favorite web browser.

* Linux / BSD / Mac OS X:

      Unpack, edit config.txt and run:
      $ perl moviecat.pl -c config.txt
      Open report/movies.html with your favorite browser.

      Note: the packaged text files are in msdos format.
      Convert them to unix format with:
      $ dos2unix *.txt doc/*.txt



Usage:
======

The directories are scanned for: *.nfo, *.txt, *.url, *.desktop files that
contain links to imdb info like this: http://www.imdb.com/title/tt0062622/

If no such link is present then the movie title and year is guessed from
directory or file name and searched on imdb for an exact match.

If none of the above methods produce valid info, then the directory is
reported in the "Missing Info" group.

You can then resolve missing info for these directories by using one of
the following methods:

 - Find the movie on imdb and then drag&drop the link from your
   browser location bar to the directory containing the movie.
   This will create a .url file (.desktop on linux) in that directory.

 - To make guessing work better rename the directory to use the format:
   "Title (Year) [optional additional info]"
   Guessing will only use Title and Year. Year is mandatory and anything
   following year is ignored.

 - Try playing with some options to relax the search:
        -my (search also if missing year in dir or file name)
        -mf (match first if multiple results)
        -aka (match AKA titles - in other language than original).
   The matching will not be so strict so you might get more hits,
   but the results might not be as accurate.

 - Manually create a .nfo or .txt file in the directory and put
   the imdb link inside.

 - Use the interactive mode to search and assign movies to directories.

 - Or choose to ignore the directory by using the -ignore or -skip options
   or using the ignoredir command in interactive mode.

After the info is added you need to re-run the scan to update the html report.

All imdb queries are cached for 30 days in imdb_cache directory so running scan
multiple times is fast.



Command Line Options:
=====================

Brief help on command line options:

Usage: perl moviecat.pl [OPTIONS] [DIRECTORY ...]
  Options:
    -h|-help|-ihelp         Help (short|long|interactive)
    -V|-version             Version
    -v/q|-verbose/quiet     Verbose/Quiet output
    -c|-config <CFGFILE>    Load configuration
    -i|-interactive         Interactive debug mode (deprecated)
    -o|-out <FILENAME>      Output path base name
    -t|-title <TITLE>       Set Title (multiple to define groups)
    -g|-group               Group separator
    -s|-skip <NAME>         Skip file or dir (recursive) 
    -ignore <DIR>           Ignore dir with missing info (not recursive)
    -user VOTES_URL         Add user's votes from imdb user's vote history url
    -subs URL               Add subtitle search site
    -link URL               Add a custom link
    -tag NAME=PATTERN       Add a tag NAME if path matches PATTERN
    -ext EXT                Add a file extension of recognized media files
    DIRECTORY               Directory to scan

  More Options:
    -tagorder TAGLIST       Specify tag order: TAG1,TAG2,TAG3,...
    -tagstate NAME=VAL      Specify default tag state: all, not, set, hide
    -x|-regex <EXPR>        Skip using regular expressions
    -ns|-noskip             Clear preset skip lists
    -gs|-gskip <NAME>       Group Skip file or dir
    -gx|-gregex <EXPR>      Group Skip using regular expressions
    -js                     Use javascript for sorting [default]
    -nojs                   Use static html for sorting
    -xml                    Export catalog to .xml files
    -nosubs                 Clear subtitle search site list
    -nolink                 Clear custom links list
    -a|-automatch           Auto guess and report exact matches [default]
    -na|-noautomatch        Disable auto match
    -m|-missing             Report folders with missing info [default]
    -nm|-nomissing          Don't report missing info
    -mm|-missmatch          Report guessed exact matches as missing
    -mf|-matchfirst         Match first if multiple matches exists
    -my|-matchyear          Match also folders with missing year
    -mfn|-matchfilename     Match also by filename [default]
    -nfn|-nomatchfilename   Don't match by filename
    -aka                    Match AKA titles (other language,..)
    -noaka                  Disable AKA titles [default]
    -as|-autosave           Save auto guessed exact matches
    -cachedays <NUM>        Number of days to cache pages [default: 90]
    -theme <NAME>           Select theme name [default: white]
    -origtitle              Use original movie title
    -deftitle               Use default (regional) movie title [default]

  Presets:
    skip list: [sample subs subtitles cover covers]
    regex skip: [/subs-.*/ /\W*sample\W*/]
    media ext: [mpg mpeg mpe mp4 avi mov qt wmv mkv iso bin cue ratdvd tivo ts divx vob nfo rar srt sub]
    codec tags: [hidef hd hdtv hddvdrip hddvd bluray bd5 bd9 720 720p 720i 1080 1080p 1080i 3D HSBS Half-SBS H-SBS Half.Over.Under Half-OU Half.OU cam ts r5 dvdscr dvdrip dvd dvd9 cd1 cd2 vcd xvid divx x264 matroska wmv dts dolby ac3 vorbis mp3 sub]
    cache dir: [imdb_cache]
    cache days: [90]
    output: [report/movies]


Option Notes:

  User Votes:

    -user VOTES_URL         Add user's votes from imdb user's vote history url

    VOTES_URL has the following format: [Name=]{URL|ID|FILE}
    Examples:
        -user http://www.imdb.com/mymovies/list?l=12345678
        -user 12345678
        -user Johnny=12345678
        -user George=myvotes.html


  Movie Tags:

    -tag NAME=PATTERN       Add a tag NAME if path matches PATTERN

    Movies can be assigned some tags, which allow additional filtering.
    Tags are assigned based on:
    - path matching (HiDef)
    - imdb movie type (TV,Video,Series)
    - movie match method (Guess)
    In a way, path matching tags are similar to groups, but
    offer more flexible filtering.

    Examples:
        -tag Seen=seen
        -tag Downloads=/Downloads/
    Multiple patterns can be specified, separated with comma, example:
        -tag HiDef=hidef,720,1080
    Note: HiDef tag is already predefined, to disable it assign it
    an empty PATTERN. Example:
        -tag HiDef=
    To add patterns to an existing tag, use += instead of = example:
        -tag HiDef+=hddvd
    Note: NAME must not contain any spaces or commas (,).


  Subtitles and Links:

    -subs URL               Add subtitle search site
    -link URL               Add a custom link

    The following patterns can be used in the URL:
        %ID%    -   Movie ID
        %TITLE% -   Movie Title
        %YEAR%  -   Movie Year
    And a custom name can be specified like this: NAME=URL

    Examples:
        -subs http://www.subtitlesource.org/title/tt%ID%
        -subs http://divxtitles.com/%TITLE%/English/any/1
        -link Trailers=http://www.imdb.com/title/tt%ID%/trailers
        -link http://www.google.com/search?q=%TITLE%
        -link http://en.wikipedia.org/wiki/Special:Search?search=%TITLE%

  Themes:
    -theme <NAME> option will select the default theme
    A new theme can be added to lib/name.css


Config File:
============

All command line options can be used in a config file.
Use only one option per line, followed by optional arguments in same line.
Empty lines and lines starting with # are ignored.
Multiple config files can be specified or nested, so you can include the
ignore list generated by the interactive ignoredir commad with:
"-c ignore.txt" from the command line or from the config file.
See doc/sample-cfg.txt for an example.



Interactive Mode:
=================

Note: this functionality is deprecated and will get removed in the future.

Start with -i option or run interactive.cmd to enter interactive debug mode.
In interactive mode, you can assign movies to directories which are missing
info (either missing a .nfo file or guessing didn't give an exact match).

Brief help on interactive commands:

TITLE (YEAR)    -  Search by TITLE [(YEAR) optional]
s TITLE (YEAR)  -  Search by TITLE [(YEAR) optional]
ID              -  Specify IMDB ID
URL             -  Specify IMDB URL

.               -  Show current dir info and guesses
l / ll          -  List relevant / all files
d / dd          -  List dirs (missing info / all)
dir             -  List sub-dirs to current dir
cd N/DIR        -  Change to dir number(N) / name(DIR)
<enter>         -  Next dir with missing info
n / p           -  Next / Previous dir
pwd             -  Print Current Dir
ignoredir       -  Add dir to ignore.txt
!CMD            -  Run command CMD in dir
r               -  Recreate Report
? / h / help    -  Print Help
q / quit        -  Quit



The Catalog Page:
=================

The created catalog is an interactive html + javascript page, which lists
all the found movies and offers sorting and filtering of them. The interface
should mostly be self explaining and intuitive, but here are a few details
worth mentioning:

Tag filtering:

Each tag can be in one of the 3 states: "all", "not", "selected".
 - "all" state: no filtering is done for this specific tag,
    so all movies are shown regardles if they contain the tag or not.
 - "not" state: only movies that don't contain the tag are matched and shown.
 - "selected" state: only movies that contain the tag are matched and shown.

This logic is then applied for each tag, and the intersection of movies
that match the set tag states is shown.

Genre filtering:

The genre filtering behaves in two different ways, depending if more than half or
less than half of the genres are selected.
- less than half genres selected:
  All movies that contain at least one of the selected genre is matched and shown. 
- more than half genres selected:
  Only movies whose all genres are selected are matched. In other words,
  movie that contains an unselected genre is not shown.
Example:
- Only "Comdey" is selected: all movies that contain comedy are shown.
- Everything but "Comedy" selected: all movies except those that
  contain comedy are shown.

To quickly select just one genre, you can just click on the genre name.



License:
========

Covered by the GPL License.
Read doc/license.txt and doc/gpl.txt for details.




