<!--Lee Kapp - CS148 Final - form to update an item record-->
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
$pmkItemNumber = (isset($_GET['item'])) ? htmlspecialchars($_GET['item']) : '';
if(isset($_POST['hiItemNum'])) {
    $pmkItemNumber = htmlspecialchars($_POST['hiItemNum']);
}

// set defaults
$fldItemName = '';
$fldCost = '';
$fldDescription = '';
$fldVendorName = '';
$fldVendorContact = '';
$fldCategory = '';
$fldItemImage = '';

$sql = 'SELECT pmkItemNumber, fldItemName, fldCost, fldDescription, fldVendorName, fldVendorContact, fldCategory, fldItemImage ';
$sql .= 'FROM tblItems WHERE pmkItemNumber = ?';
$data = array($pmkItemNumber);
$items = $thisDatabaseReader->select($sql, $data);
?>

<main id="updatePage">

    <h2>Updating
        <?php
        print '<p>Item: ' . $items[0]['fldItemName'] . '</p>';
        ?>
    </h2>

<?php
// setting variable values to sanitized inputs from form that have been retrieved from the database
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

    // set values of the update array to the sanitized values from the form
    if ($saveData) {
        $toUpdate = array();
        $toUpdate[] = $fldItemName;
        $toUpdate[] = $fldCost;
        $toUpdate[] = $fldDescription;
        $toUpdate[] = $fldVendorName;
        $toUpdate[] = $fldVendorContact;
        $toUpdate[] = $fldCategory;
        $toUpdate[] = $fldItemImage;
        $toUpdate[] = $pmkItemNumber;

        $sql = 'UPDATE tblItems SET ';
        $sql .= 'fldItemName = ?, ';
        $sql .= 'fldCost = ?, ';
        $sql .= 'fldDescription = ?, ';
        $sql .= 'fldVendorName = ?, ';
        $sql .= 'fldVendorContact = ?, ';
        $sql .= 'fldCategory = ?, ';
        $sql .= 'fldItemImage = ? ';
        $sql .= 'WHERE pmkItemNumber = ?';

        $status = $thisDatabaseWriter->update($sql, $toUpdate);

        if ($status) {
            print '<p>Success! You\'ve updated this item record.</p>';
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

    <main class="itemUpdatePage">
        <form action="<?php print PHP_SELF; ?>" id="updateRecord" method="POST">
            <fieldset class="insert">
                <input type="hidden" value="<?php print $items[0]['pmkItemNumber'] ?>" id="hiItemNum" name="hiItemNum">

                <p><legend>Enter the vendor's item number</legend></p>
                <input type="text" id="txtItemNum" name="txtItemNum" placeholder="Item Number" value="<?php print $items[0]['pmkItemNumber'] ?>" required>

                <p><legend>Enter the item's name</legend></p>
                <input type="text" id="txtItemName" name="txtItemName" placeholder="Item Name" value="<?php print $items[0]['fldItemName'] ?>" required>

                <p><legend>Enter the item's cost in U.S. dollars</legend></p>
                <input type="text" id="txtItemCost" name="txtItemCost" placeholder="Item Cost" value="<?php print $items[0]['fldCost'] ?>" required>

                <p><label for="txtDescription">Item's description</label></p>
                <textarea id="txtDescription" name="txtDescription" cols="75" rows="7" required><?php print $items[0]['fldDescription'] ?></textarea>

                <p><legend>Enter the vendor's name</legend></p>
                <input type="text" id="txtVendorName" name="txtVendorName" placeholder="Vendor Name" value="<?php print $items[0]['fldVendorName'] ?>" required>

                <p><label for="txtVendorContact">Vendor's contact information</label></p>
                <textarea id="txtVendorContact" name="txtVendorContact" cols="75" rows="5" required><?php print $items[0]['fldVendorContact'] ?></textarea>

                <p><legend>Enter the item's category</legend></p>
                <input type="text" id="txtCategory" name="txtCategory" placeholder="Item's Category" value="<?php print $items[0]['fldCategory'] ?>" required>

                <p><legend>Enter the filename for the image</legend></p>
                <input type="text" id="txtItemImage" name="txtItemImage" placeholder="Item's Image Filename" value="<?php print $items[0]['fldItemImage'] ?>" required>

                <p><input id="submitbtn" type="submit" value="Update Record"  name="submitBtn"</p>
            </fieldset>
        </form>
    </main>

    <?php
    include 'adFooter.php';
    ?>
