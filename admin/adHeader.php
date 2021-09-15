<!--Lee Kapp - CS148 Final - admin/header file-->
<header>
    <?php
    $task = '';
    if (PATH_PARTS['filename'] == "selectTable") {
    $task = ' select a table to modify.';
    }

    if (PATH_PARTS['filename'] == "perCategoryReport") {
        $task = ' obtain a report of total expenditures per item category.';
    }

    if (PATH_PARTS['filename'] == "perPersonReport") {
        $task = ' obtain a report of total expenditures per person.';
    }

    if (PATH_PARTS['filename'] == "insertCategoryRecord") {
        $task = ' insert a record.';
    }
    if (PATH_PARTS['filename'] == "insertProjectRecord") {
        $task = ' insert a record.';
    }
    if (PATH_PARTS['filename'] == "insertPersonnelRecord") {
        $task = ' insert a record.';
    }
    if (PATH_PARTS['filename'] == "insertItemRecord") {
        $task = ' insert a record.';
    }
    if (PATH_PARTS['filename'] == "insertOrderRecord") {
        $task = ' insert a record.';
    }

    if (PATH_PARTS['filename'] == "deleteCategory") {
        $task = ' delete a record.';
    }
    if (PATH_PARTS['filename'] == "deleteProject") {
        $task = ' delete a record.';
    }
    if (PATH_PARTS['filename'] == "deletePerson") {
        $task = ' delete a record.';
    }
    if (PATH_PARTS['filename'] == "deleteItems") {
        $task = ' delete a record.';
    }
    if (PATH_PARTS['filename'] == "deleteOrders") {
        $task = ' delete a record.';
    }

    if (PATH_PARTS['filename'] == "displayTblCategory") {
        $task = ' update or delete a record.';
    }
    if (PATH_PARTS['filename'] == "displayTblProject") {
        $task = ' update or delete a record.';
    }
    if (PATH_PARTS['filename'] == "displayTblPersonnel") {
        $task = ' update or delete a record.';
    }
    if (PATH_PARTS['filename'] == "displayTblItems") {
        $task = ' update or delete a record.';
    }
    if (PATH_PARTS['filename'] == "displayTblOrders") {
        $task = ' update or delete a record.';
    }


    print '<h1>Admin Page to' . $task . '</h1>';
    ?>
</header>
