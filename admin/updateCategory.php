<!--Lee Kapp - CS148 Final - form to update a category record-->
<?php
include 'adTop.php';

function getData($field) {
    if (!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data, ENT_QUOTES);
    }
    return $data;
}

function saniText($field) {
    return(preg_match("/^([[:alnum:]]|-|\.|(|)| |,|%|&|;|#||)+$/i", $field[0]));
}

const UP_DEBUG = false; // debugging constant

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

<main id="updatePage">

    <h2>Update
        <?php
        print '<p>Category: ' . $categories[0]['pmkCategoryName'] . '</p>';
        ?>
    </h2>


    <?php
    print('<figure class="catToUpdate">');
    print('<a href="updateCategory.php?category=' . $categories[0]['pmkCategoryName'] . '">'
        . '<img alt="' . $categories[0]['pmkCategoryName'] . '" src = "../images/' . $categories[0]['fldCategoryImage'] . '"></a>');
    print('<figcaption>' . $categories[0]['pmkCategoryName'] . '</figcaption>');
    print('</figure>');

// setting variable values to sanitized inputs from form that have been retrieved from the database
if(isset($_POST['submitBtn'])) {
    $pmkCategoryName = getData('txtCategoryName');
    $fldCategoryImage = getData('txtCategoryImage');

    $saveData = true;

    if ($pmkCategoryName = '') {
        print '<p class="mistake">Please enter a category name.</p>';
        $saveData = false;
    } else if (!saniText($pmkCategoryName)) {
        print '<p class="mistake">Please make sure to only enter valid text for category name.</p>';
        $saveData = false;
    }
    if ($fldCategoryImage = '') {
        print '<p class="mistake">Please enter a filename for the category image.</p>';
        $saveData = false;
    } else if (!saniText($fldCategoryImage)) {
        print '<p class="mistake">Please make sure to only enter valid text for main image.</p>';
        $saveData = false;
    }

// set values of the update array to the sanitized values from the form
    if ($saveData) {
        $toUpdate = array();
        $toUpdate[] = $pmkCategoryName;
        $toUpdate[] = $fldCategoryImage;

        $sql = 'UPDATE tblCategory SET ';
        $sql .= 'fldCategoryImage = ? ';
        $sql .= 'WHERE pmkCategoryName = ?';

        $status = $thisDatabaseWriter->update($sql, $toUpdate);

        if ($status) {
            print '<p>Success! You\'ve updated this category.</p>';
        } else {
            print '<p>Couldn\'t complete the update. Please check that your information is correct :(</p>';
        }

        //Print the post array if the form is submitted and if DEBUG is set to true
        if (UP_DEBUG) {
            print('<p>POST array:</p><pre>');
            print_r($_POST);
            print('</pre>');
            print('<p>Updating:</p><pre>');
            print_r($toUpdate);
            print('</pre>');
            print('<p>SQL:</p><pre>');
            print_r($sql);
            print('</pre>');
        }
    }
}
?>
<main class="categoryUpdatePage">

<!--Form to insert a new record into table category-->
    <form action="<?php print PHP_SELF; ?>" id="updateRecord" method="POST">
        <fieldset class="update">
            <input type="hidden" value="<?php print $categories[0]['pmkCategoryName'] ?>" id="hiCatName" name="hiCatName">

            <p><legend>Enter a category name</legend></p>
            <input type="text" id="txtCategoryName" name="txtCategoryName" placeholder="Category Name" value="<?php print $categories[0]['pmkCategoryName'] . PHP_EOL; ?>" required>

            <p><legend>Enter the filename for the category image</legend></p>
            <input type="text" id="txtCategoryImage" name="txtCategoryImage" placeholder="Filename for Category Image" value="<?php print $categories[0]['fldCategoryImage'] . PHP_EOL; ?>" required>

            <p><input id="submitBtn" type="submit" value="Update Record"  name="submitBtn"</p>
        </fieldset>
    </form>
</main>

<?php
include 'adFooter.php';
?>




