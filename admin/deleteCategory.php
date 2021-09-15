<!--Lee Kapp - CS148 Final - delete a category-->
<?php
include 'adTop.php';

function getData($field)
{
    if (!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data, ENT_QUOTES);
    }
    return $data;
}

const Del_DEBUG = false;

// pull data from database to initialize variables
$pmkCategoryName = (isset($_GET['category'])) ? htmlspecialchars($_GET['category']) : '';
if(isset($_POST['hiCatName'])) {
    $pmkCategoryName = htmlspecialchars($_POST['hiCatName']);
}

//set defaults and pull from the database
$fldCategoryImage = '';

$sql =  'SELECT pmkCategoryName, fldCategoryImage FROM tblCategory WHERE pmkCategoryName = ?';
$data = array($pmkCategoryName);
$categories = $thisDatabaseReader->select($sql, $data);
?>

<main id="deletePage">
    <h2>Delete
        <?php print($pmkCategoryName);
        print '<p>Category: ' . $pmkCategoryName . '</p>';
        ?>
    </h2>

    <?php
    print('<figure class="catToDelete">');
    print('<a href="deleteCategory.php?anID=' . $categories[0]['pmkCategoryName'] . '">'
        . '<img alt="' . $categories[0]['pmkCategoryName'] . '" src = "../images/' . $categories[0]['fldCategoryImage'] . '"></a>');
    print('<figcaption>' . $categories[0]['pmkCategoryName'] . '</figcaption>');
    print('</figure>');


    if (Del_DEBUG) {
        print('<p>Category to delete:</p><pre>');
        print 'Category: ' . $pmkCategoryName;
        print ' SQL statement: ' .$sql;
        print_r($data);
        print('</pre>');
    }

    if(isset($_POST['deleteBtn'])) {
        $data = getData('hiCatName');

        $sql = 'DELETE FROM tblCategory ';
        $sql .= 'WHERE pmkCategoryName = ?';

        $status = $thisDatabaseWriter->delete($sql, $data);
        if($status){
            //print '<a href="confPage.php"' . '>';
            print '<p>Success! You\'ve deleted this category from tblCategory.</p>';
        } else {
            print '<p>Couldn\'t complete the deletion. Please check that your information is correct :(</p>';
        }
    }
    ?>

    <!--Form to delete a category from tblCategpry-->
    <form action="<?php print PHP_SELF; ?>" id="deleteRecord" method="POST">
        <fieldset class="delete">
            <input type="hidden" value="<?php print $categories[0]['pmkCategoryName'] ?>" id="hiCatName" name="hiCatName">
            <p>Press the delete button if you are certain that you want to delete this category from tblCategory</p>
            <p><input id="deleteBtn" type="submit" value="Delete Record"  name="deleteBtn"</p>
        </fieldset>
    </form>
</main>

<?php
include 'adFooter.php';
?>

