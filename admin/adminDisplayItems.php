<!--Lee Kapp - CS148 Final - displayItems.php-->

<?php
include 'adTop.php';

$itemCat = (isset($_GET['category'])) ? htmlspecialchars($_GET['category']) : '';

$sql =  'SELECT fldItemImage, pmkItemNumber, fldItemName, fldDescription, fldCost, fldVendorName, fldCategory ';
$sql .= 'FROM tblItems ';
$sql.=  'WHERE fldCategory = ? ';
$sql .= 'ORDER BY fldItemName';

$data = array($itemCat);
$items = $thisDatabaseReader->select($sql, $data);


print('<main>');
    print '<section id="deleteOptions">';
if(is_array($items)) {
    foreach($items as $item) {
        print('<figure class="itemToDelete">');
        print('<img alt="' . $item['fldItemName'] . '" src = "../images/' . $item['fldItemImage'] . '"></a>');
        print('<figcaption>' . $item['fldItemName'] . '</figcaption>');
        print '<a href="deleteRecord.php?itemID='. $item['pmkItemNumber'].'"><button id="delBtn">Delete Item?</button></a>';
        print '<a href="updateRecord.php?itemID='. $item['pmkItemNumber'].'"><button id="upBtn">Update Item?</button></a>';
        print('</figure>');
    }
}
    print '</section>';
print('</main>');

include 'adFooter.php';
?>




