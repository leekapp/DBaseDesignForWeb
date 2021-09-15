<!--Lee Kapp - CS148 Final - admin/top.php file-->
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Lee Kapp">
        <meta name="description"
              content="Admin Site for Database Design for Web at UVM.">
        <title>Lee Kapp's Admin Site for the Laboratory Inventory Database</title>

        <link rel ="stylesheet"
            href = "../css/custom.css?version=<?php print time(); ?>"
            type = "text/css">
        <link rel ="stylesheet" media="(max-width:800px)"
            href ="../css/tablet.css?version=<?php print time(); ?>"
            type  ="text/css">
        <link rel ="stylesheet" media="(max-width:600px)"
            href ="../css/phone.css?version=<?php print time(); ?>"
            type ="text/css">

<?php
//****** include libraries ******
$path = '../lib/';
//if (substr(BASE_PATH, -6) == 'admin/'){
//    $path = '../' . $path;
//}

include $path . 'constants.php';

print'<!-- make Database connections -->';
require_once($path . 'Database.php');

$thisDatabaseReader = new Database('lkapp_reader', 'r', DATABASE_NAME);
$thisDatabaseWriter = new Database('lkapp_writer', 'w', DATABASE_NAME);

// Administrator login
$pmkNetId = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");

if($pmkNetId != '') {
    $sql = 'SELECT fldFirstName, fldLastName, fldSecurityLevel ';
    $sql .= 'FROM tblAdminLogin ';
    $sql .= 'WHERE pmkNetId = ?';
    $data = array($pmkNetId);
    $administrator = $thisDatabaseReader->select($sql, $data);

    if(empty($administrator)) {
        $adminLoggedIn = false;
    } elseif($administrator[0]['fldSecurityLevel'] != 'Full') {
        $adminLoggedIn = false;
    } else {
        $adminLoggedIn = true;
    }
    if(!$adminLoggedIn) {
        print '<p>We are sorry, but an error has occurred. Contact your administrator.</p>';
        die();
    }
}

print('</head>');

print('<body  id = "' . PATH_PARTS['filename'] . '">');

print('<!-- ***** START OF BODY ***** -->');

print(PHP_EOL);

include 'adHeader.php';
print(PHP_EOL);

include 'adNav.php';
print(PHP_EOL);
?>
