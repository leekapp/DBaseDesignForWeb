<?php
include 'adTop.php';

$sql =  'SELECT pmkOrderNumber, fnkEmployeeEmail, fldOrderDate, fnkItemName, fnkProjectName FROM tblOrders';

$data = '';
$orders = $thisDatabaseReader->select($sql, $data);

print('<main>');
print '<section id="modifyOptions">';
if(is_array($orders)) {
    foreach($orders as $order) {
        print '<p>' . $order['pmkOrderNumber'] . ' ' . $order['fnkEmployeeEmail'] . ' ' . $order['fldOrderDate'] . ' ' . $order['fnkItemName'] . ' '. $order['fnkProjectName'] . '</p>';

        print '<a href="deleteOrder.php?orderNum='. $order['pmkOrderNumber'] .'"><button id="delBtn">Delete ' . $order['pmkOrderNumber'] . '?</button></a>';
        print '<a href="updateOrder.php?orderNum='. $order['pmkOrderNumber'] .'"><button id="upBtn">Update ' . $order['pmkOrderNumber']. '?</button></a>';
    }
}
print '</section>';
print('</main>');

include 'adFooter.php';
?>