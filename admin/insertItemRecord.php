<!--Lee Kapp - CS148 Final - form to insert a new item record-->
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

// set defaults
$pmkItemNumber = '';
$fldItemName = '';
$fldCost = '';
$fldDescription = '';
$fldVendorName = '';
$fldVendorContact = '';
$fldCategory = '';
$fldItemImage = '';
?>

<main id="itemInsertPage">

    <?php
    //Print the post array if the form is submitted and if DEBUG is set to true
    if(isset($_POST['submitBtn'])) {
        $pmkItemNumber = getData('txtItemNum');
        $fldItemName = getData('txtItemName');
        $fldCost = getData('txtItemCost');
        $fldDescription = getData('txtDescription');
        $fldVendorName = getData('txtVendorName');
        $fldVendorContact = getData('txtVendorContact');
        $fldCategory = getData('txtCategory');
        $fldItemImage = getData('txtItemImage');

        $saveData = true;

        if (!saniText($pmkItemNumber)) {
            print '<p class="mistake">Please make sure to only enter valid text for item number.</p>';
            $saveData = false;
        }
        if (!saniText($fldItemName)) {
            print '<p class="mistake">Please make sure to only enter valid text for item name.</p>';
            $saveData = false;
        }
        if (!saniText($fldCost)) {
            print '<p class="mistake">Please make sure to only enter valid text for item cost.</p>';
            $saveData = false;
        }
        if (!saniText($fldDescription)) {
            print '<p class="mistake">Please make sure to only enter valid text for item description.</p>';
            $saveData = false;
        }
        if (!saniText($fldVendorName)) {
            print '<p class="mistake">Please make sure to only enter valid text for vendor name.</p>';
            $saveData = false;
        }
        if (!saniText($fldVendorContact)) {
            print '<p class="mistake">Please make sure to only enter valid text for vendor contact.</p>';
            $saveData = false;
        }
        if (!saniText($fldCategory)) {
            print '<p class="mistake">Please make sure to only enter valid text for category name.</p>';
            $saveData = false;
        }
        if (!saniText($fldItemImage)) {
            print '<p class="mistake">Please make sure to only enter valid text for main image.</p>';
            $saveData = false;
        }

        // if saveData == true, then prepare the insert statement - have to pass an array of values from form input as 'values' in the insert function
        if ($saveData) {
            $toInsert = array($pmkItemNumber, $fldItemName, $fldCost, $fldDescription, $fldVendorName, $fldVendorContact, $fldCategory, $fldItemImage);

            $sql = 'INSERT INTO tblItems SET ';
            $sql .= 'pmkItemNumber= ?, ';
            $sql .= 'fldItemName = ?, ';
            $sql .= 'fldCost = ?, ';
            $sql .= 'fldDescription = ?, ';
            $sql .= 'fldVendorName = ?, ';
            $sql .= 'fldVendorContact = ?, ';
            $sql .= 'fldCategory = ?, ';
            $sql .= 'fldItemImage = ?';

            $status = $thisDatabaseWriter->insert($sql, $toInsert);
            if ($status) {
                print '<p>Success! You\'ve entered this item\'s information into tblItems.</p>';
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

    <!--Form to insert a new item into tblItem-->
    <form action="<?php print PHP_SELF; ?>" id="insertRecord" method="POST">
        <fieldset class="insert">
            <p><legend>Enter the vendor's item number</legend></p>
            <input type="text" id="txtItemNum" name="txtItemNum" placeholder="Item Number" value="<?php if(isset($_POST['txtItemNum'])) echo $_POST['txtItemNum'] ?>" required>

            <p><legend>Enter the item's name</legend></p>
            <input type="text" id="txtItemName" name="txtItemName" placeholder="Item Name" value="<?php if(isset($_POST['txtItemName'])) echo $_POST['txtItemName'] ?>" required>

            <p><legend>Enter the item's cost in U.S. dollars</legend></p>
            <input type="text" id="txtItemCost" name="txtItemCost" placeholder="Item Cost" value="<?php if(isset($_POST['txtItemCost'])) echo $_POST['txtItemCost'] ?>" required>

            <p><label for="txtDescription">Item's description</label></p>
            <textarea id="txtDescription" name="txtDescription" cols="75" rows="7" required><?php if(isset($_POST['txtDescription'])) echo $_POST['txtDescription'] ?></textarea>

            <p><legend>Enter the vendor's name</legend></p>
            <input type="text" id="txtVendorName" name="txtVendorName" placeholder="Vendor Name" value="<?php if(isset($_POST['txtVendorName'])) echo $_POST['txtVendorName'] ?>" required>

            <p><label for="txtVendorContact">Vendor's contact information</label></p>
            <textarea id="txtVendorContact" name="txtVendorContact" cols="75" rows="5" required><?php if(isset($_POST['txtVendorContact'])) echo $_POST['txtVendorContact'] ?></textarea>

            <p><legend>Enter the item's category</legend></p>
            <input type="text" id="txtCategory" name="txtCategory" placeholder="Item's Category" value="<?php if(isset($_POST['txtCategory'])) echo $_POST['txtCategory'] ?>" required>

            <p><legend>Enter the filename for the image</legend></p>
            <input type="text" id="txtItemImage" name="txtItemImage" placeholder="Item's Image Filename" value="<?php if(isset($_POST['txtItemImage'])) echo $_POST['txtItemImage'] ?>" required>

            <p><input id="submitbtn" type="submit" value="Insert Record"  name="submitBtn"</p>
        </fieldset>
    </form>
</main>

<?php
include 'adFooter.php';
?>



