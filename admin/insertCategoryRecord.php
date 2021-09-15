<!--Lee Kapp - CS148 Final - form to insert a new category record-->
<?php
include 'adTop.php';

//to sanitize data from form - server side validation
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

//set defaults
$fldCategoryName = '';
$fldCategoryImage = '';


//$pmkOrderId = '';
//$fpkEmployeeEmail = '';
//$fnkItemNumber = '';
//$fnkProjectId = '';
//$fpkOrderDate = '';
//$fldQuantity = '';

?>

<main id="catInsertPage">

<?php
//Print the post array if the form is submitted and if DEBUG is set to true
if(isset($_POST['submitBtn'])) {
    $fldCategoryName = getData('txtCategoryName');
    $fldCategoryImage = getData('txtCategoryImage');
    $saveData = true;

    if ($fldCategoryName = '') {
        print '<p class="mistake">Please enter a category name.</p>';
        $saveData = false;
    } else if (!saniText($fldCategoryName)) {
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

    // if saveData == true, then prepare the insert statement - have to pass an array of values from form input as 'values' in the insert function
    if ($saveData) {
        $toInsert = array($fldCategoryName, $fldCategoryImage);

        $sql = 'INSERT INTO tblCategory (fldCategoryName, fldCategoryImage) ';
        $sql .= 'VALUES (?, ?)';

        $status = $thisDatabaseWriter->insert($sql, $toInsert);
        if ($status) {
            print '<p>Success! You\'ve entered this critter\'s information into tblWildlife.</p>';
        } else {
            '<p>Couldn\'t complete the insertion. Please check that your information is correct :(</p>';
        }

        if (DEBUG) {
            print('<p>POST array:</p><pre>');
            print_r($_POST);
            print('</pre>');
        }
    }
}
?>

<!--Form to insert a new record into table category-->
<form action="<?php print PHP_SELF; ?>" id="insertRecord" method="POST">
    <fieldset class="insert">
        <p><legend>Enter a category name</legend></p>
        <input type="text" id="txtCategoryName" name="txtCategoryName" placeholder="Category Name" value="<?php if(isset($_POST['txtCategoryName'])) echo $_POST['txtCategoryName'] ?>" required>

        <p><legend>Enter the filename for the category image</legend></p>
        <input type="text" id="txtCategoryImage" name="txtCategoryImage" placeholder="Filename for category image" value="<?php if(isset($_POST['txtCategoryImage'])) echo $_POST['txtCategoryImage']?>" required>

        <p><input id="submitbtn" type="submit" value="Insert Record"  name="submitBtn"</p>
    </fieldset>
</form>

</main>

<?php
include 'adFooter.php';
?>

