<!--Lee Kapp - CS148 Final - displayItems.php-->

<?php
include 'top.php';

$itemCat = (isset($_GET['category'])) ? htmlspecialchars($_GET['category']) : '';

$sql =  'SELECT fldItemImage, pmkItemNumber, fldItemName, fldDescription, fldCost, fldVendorName, fldCategory ';
$sql .= 'FROM tblItems ';
$sql.=  'WHERE fldCategory = ? ';
$sql .= 'ORDER BY pmkItemNumber';

$data = array($itemCat);
$items = $thisDatabaseReader->select($sql, $data);

print('<main>');
    print '<section id="itempage">';
    if(is_array($items)){
        foreach ($items as $item){
            print('<figure class="displayitem">');
            print('<img alt="' . $item['fldItemName'] . '" src = "images/' . $item['fldItemImage'] . '">');
            print('<figcaption>' . $item['fldItemName']) . PHP_EOL;
            print('<h3 id="description">Item Description</h3>');
            print($item['fldDescription']) . PHP_EOL;
            print('<h3 id="cost">Item Cost</h3>');
            print ($item['fldCost']) . PHP_EOL;
            print('<h3 id="vendorname">Vendor Name</h3>') . PHP_EOL;
            print ($item['fldVendorName']) . PHP_EOL;
            print '<p><a href="orderItem.php?itemNum='. $item['pmkItemNumber'].'"><button id="orderBtn">Order this item!</button></a></p>';
            print('</figcaption>');
            print('</figure>');
        }
    }
    print '</section>';
print('</main>');

include 'footer.php';
?>




