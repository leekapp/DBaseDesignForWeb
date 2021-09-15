<?php
include 'adTop.php';

$sql =  'SELECT pmkItemNumber, fldItemName, fldCost, fldDescription, fldVendorName, fldVendorContact, fldCategory, fldItemImage FROM tblItems ORDER BY fldItemName';

$data = '';
$items = $thisDatabaseReader->select($sql, $data);

print('<main>');
print '<section id="catDisp">';
if(is_array($items)) {
    foreach($items as $item) {
        print('<figure class="itemToModify">');
        print('<img alt="' . $item['fldItemName'] . '" src = "../images/' . $item['fldItemImage'] . '"></a>');
        print('<figcaption>' . $item['fldItemName'] . '</figcaption>');
        print '<a href="deleteItem.php?item='. $item['pmkItemNumber'].'"><button id="delBtn">Delete Item?</button></a>';
        print '<a href="updateItem.php?item='. $item['pmkItemNumber'].'"><button id="upBtn">Update Item?</button></a>';
        print('</figure>');
    }
}
print '</section>';
print('</main>');

include 'adFooter.php';
?>

