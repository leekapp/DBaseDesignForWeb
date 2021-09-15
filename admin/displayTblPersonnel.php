<?php
include 'adTop.php';

$sql =  'SELECT pmkEmployeeEmail, fldEmployeeFName, fldEmployeeLName, fldJobTitle FROM tblPersonnel ORDER BY pmkEmployeeEmail';

$data = '';
$people = $thisDatabaseReader->select($sql, $data);

print('<main>');
print '<section id="modifyOptions">';
if(is_array($people)) {
    foreach($people as $person) {
        print '<p>' . $person['fldEmployeeFName'] . ' ' . $person['fldEmployeeLName'] . ' ' . $person['pmkEmployeeEmail'] . ' ' . $person['fldJobTitle'] . '</p>';

        print '<a href="deletePerson.php?person='. $person['pmkEmployeeEmail'] .'"><button id="delBtn">Delete ' . $person['fldEmployeeFName']. '?</button></a>';
        print '<a href="updatePerson.php?person='. $person['pmkEmployeeEmail'] .'"><button id="upBtn">Update ' . $person['fldEmployeeFName']. '?</button></a>';
    }
}
print '</section>';
print('</main>');

include 'adFooter.php';
?>


