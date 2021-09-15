<?php
include 'adTop.php';

$sql =  'SELECT pmkCategoryName, fldCategoryImage FROM tblCategory ORDER BY pmkCategoryName';

$data = '';
$categories = $thisDatabaseReader->select($sql, $data);

print('<main>');
print '<section id="catDisp">';
if(is_array($categories)) {
    foreach($categories as $category) {
        print('<figure class="catToModify">');
        print('<img alt="' . $category['pmkCategoryName'] . '" src = "../images/' . $category['fldCategoryImage'] . '"></a>');
        print('<figcaption>' . $category['pmkCategoryName'] . '</figcaption>');
        print '<p><a href="deleteCategory.php?category='. $category['pmkCategoryName'].'"><button id="delBtn">Delete Category?</button></a>';
        print '<a href="updateCategory.php?category='. $category['pmkCategoryName'].'"><button id="upBtn">Update Category?</button></a></p>';
        print('</figure>');
    }
}
print '</section>';
print('</main>');

include 'adFooter.php';
?>

