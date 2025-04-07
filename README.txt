Results of the codebase refactor:

All future changes to the css will go in the stylesheets.css file kept in the css folder.
Only if there is a specific change to be made to exactly one of the web pages that needs
to override an existing css feature in the stylesheet.css file will you put css inside of
a <style></style> html tag for that particular web page and only thatweb page. Copy the
following html code and paste it inside of the file's <head></head>tag to include all of
the css that is to be shared among multiple files:
<link href="../css/stylesheet.css" type="text/css" rel="stylesheet" />

All images to be used in the website will be kept in the images folder under the www
folder.

The scripts folder will be used to organize various sugar-feature functionality using
JavaScript. All functions that are shared across multiple pages will be contained in
this folder.

The following comment notations will be adopted for distinguishing between each of the
5 languages used on this project and to enhance readability:
<!-- html comment notation -->
/* css comment notation */
// JavaScript comment notation
# PHP comment notation
-- MySQL comment notation

Finally, the database has been renamed from mydb to MariaSQL. For all future use of the
database please refer to it as MariaSQL.
