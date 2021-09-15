<!--Lee Kapp - CS148 Final - header file-->
<header>
    <h1>Welcome to the Laboratory Inventory Database</h1>
    <?php
    $pmkCategoryName = (isset($_GET['category'])) ? htmlspecialchars($_GET['category']) : '';
    if($pmkCategoryName == 'Molecular Biology') {
        $pmkCategoryName = 'Molecular Biology Reagents';
    }
    if (PATH_PARTS['filename'] != "index") {
        if (PATH_PARTS['filename'] != "contact") {
            print '<h2>Order ' . $pmkCategoryName . ' Here!</h2>';
        }
    }
    ?>
</header>
