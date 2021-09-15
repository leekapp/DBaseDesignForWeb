<?php
include 'adTop.php';

$sql =  'SELECT SUM(fldCost), fnkItemNumber, fnkItemName, fldCategory FROM tblOrders JOIN tblItems ON fnkItemNumber = pmkItemNumber GROUP BY fldCategory';

$data = '';
$reports = $thisDatabaseReader->select($sql, $data);
?>

<main>
    <section class="report">
    <table id="catReport">
        <tr>
            <th>Total Cost</th>
            <th></th>
            <th>Item Number</th>
            <th>Item Name</th>
            <th></th>
            <th>Category</th>
        </tr>

        <?php
        foreach($reports as $report) {
            print '<tr><td>' . $report['SUM(fldCost)'] .'</td>'. '<td></td>' . '<td>' . $report['fnkItemNumber'] . '</td>' . '<td>' .
                $report['fnkItemName'] . '</td>'.'<td></td>' . '<td>' . $report['fldCategory'] . '</td></tr>';
        }
        ?>
    </section>
</main>

<?php
include 'adFooter.php';
?>

