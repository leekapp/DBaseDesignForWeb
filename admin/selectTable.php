<!--Lee Kapp - CS148 Final - page to select table to insert record into-->
<?php
include 'adTop.php';
?>

<main id="selectTable">
    <fieldset class="insertTableSelect">
        <legend>Select a table for the insertion of a new record</legend>
        <a href="insertCategoryRecord.php"><button id="tableBtn">Table Category</button></a>
        <a href="insertProjectRecord.php"><button id="tableBtn">Table Project</button></a>
        <a href="insertPersonnelRecord.php"><button id="tableBtn">Table Personnel</button></a>
        <a href="insertItemRecord.php"><button id="tableBtn">Table Items</button></a>
    </fieldset>

    <p></p>
    <fieldset class="alterTableSelect">
        <legend>Select a table to update or delete a record</legend>
        <a href="displayTblCategory.php"><button id="tableBtn">Table Category</button></a>
        <a href="displayTblProject.php"><button id="tableBtn">Table Project</button></a>
        <a href="displayTblPersonnel.php"><button id="tableBtn">Table Personnel</button></a>
        <a href="displayTblItems.php"><button id="tableBtn">Table Items</button></a>
        <a href="displayTblOrders.php"><button id="tableBtn">Table Orders</button></a>
    </fieldset>

</main>

<?php
include 'adFooter.php';
?>
