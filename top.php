<!--Lee Kapp - CS148 Final - top.php file-->
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Lee Kapp">
        <meta name="description"
              content="A web-based laboratory inventory database for Database Design for Web at UVM.">
        <title>Lee Kapp's Laboratory Ordering Database for CS148</title>

        <link rel ="stylesheet"
            href = "css/custom.css?version=<?php print time(); ?>"
            type = "text/css">
        <link rel ="stylesheet" media="(max-width:800px)"
            href ="css/tablet.css?version=<?php print time(); ?>"
            type  ="text/css">
        <link rel ="stylesheet" media="(max-width:600px)"
            href ="css/phone.css?version=<?php print time(); ?>"
            type ="text/css">

<?php
//****** include libraries ******
include 'lib/constants.php';

print'<!-- make Database connections -->';
require_once(LIB_PATH . 'Database.php');

$thisDatabaseReader = new Database('lkapp_reader', 'r', DATABASE_NAME);
$thisDatabaseWriter = new Database('lkapp_writer', 'w', DATABASE_NAME);

print('</head>');

print('<body  id = "' . PATH_PARTS['filename'] . '">');

print('<!-- ***** START OF BODY ***** -->');

print(PHP_EOL);

include 'header.php';
print(PHP_EOL);

include 'nav.php';
print(PHP_EOL);
?>
