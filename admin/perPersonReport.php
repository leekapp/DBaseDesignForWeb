<?php
include 'adTop.php';

$sql = 'SELECT SUM(fnkCost), pmkEmployeeEmail, CONCAT(fldEmployeeFName, fldEmployeeLName) as fullName FROM tblOrders
JOIN tblPersonnel ON fnkEmployeeEmail = pmkEmployeeEmail GROUP BY fullName';
$data = '';
$reports = $thisDatabaseReader->select($sql, $data);
?>

<main class="report">
    <section class="report">
        <table id="personReport">
            <tr>
                <th>Total Cost</th>
                <th></th>
                <th>Employee</th>
                <th></th>
                <th>Employee Email</th>
            </tr>

            <?php
            foreach($reports as $report) {
                print '<tr><td>' . $report['SUM(fnkCost)'] .'</td>'. '<th></th>' . '<td>' . $report['fullName'] . '</td>' . '<th></th>' . '<td>' .
                    $report['pmkEmployeeEmail'] . '</td></tr>';
            }
            ?>
    </section>
</main>

<?php
include 'adFooter.php';
?>
