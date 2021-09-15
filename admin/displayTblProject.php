<?php
include 'adTop.php';

$sql =  'SELECT pmkProjectName, fldFundingSource FROM tblProject';

$data = '';
$projects = $thisDatabaseReader->select($sql, $data);

print('<main>');
print '<section id="modifyOptions">';
if(is_array($projects)) {
    foreach($projects as $project) {
        print '<p>' . $project['pmkProjectName'] . ' ' . $project['fldFundingSource'] . '</p>';

        print '<a href="deleteProject.php?project='. $project['pmkProjectName'].'"><button id="delBtn">Delete ' . $project['pmkProjectName'] . '?</button></a>';
        print '<a href="updateProject.php?project='. $project['pmkProjectName'] .'"><button id="upBtn">Update ' . $project['pmkProjectName'] . '?</button></a>';
    }
}
print '</section>';
print('</main>');

include 'adFooter.php';
?>

