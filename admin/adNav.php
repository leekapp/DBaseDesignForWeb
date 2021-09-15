<!--Lee Kapp - CS148 Assignment 4 - admin/nav file-->
<!--Lee Kapp - CS148 Final  - nav file-->
<nav>
    <a class="<?php
    if (PATH_PARTS['filename'] == "index") {
        print 'activePage';
    }
    ?>" href="../index.php">Home</a>

    <!--    <a class="--><?php
    //    if (PATH_PARTS['filename'] == "about") {
    //        print 'activePage';
    //    }
    //    ?><!--" href="about.php">About</a>-->

    <a class="<?php
    if (PATH_PARTS['filename'] == "contact") {
        print 'activePage';
    }
    ?>" href="../contact.php">Contact</a>

    <a class="<?php
    if (PATH_PARTS['filename'] == "dict") {
        print 'activePage';
    }
    ?>" href="../dict.php">Data Dictionary</a>

    <div class="dropdown">
        <a class="<?php
        if (PATH_PARTS['filename'] == "admin") {
            print 'dropbtn' . 'activePage';
        }
        ?>" href="../admin.php">Admin</a>
        <div class="dropdown-content">
            <a href="../index.php">Home Page</a>
            <a href="selectTable.php">Insert, Update, or Delete New Record</a>
            <a href="perCategoryReport.php">Report per Category</a>
            <a href="perPersonReport.php">Report per Person</a>
        </div>
    </div>
</nav>

