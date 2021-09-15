<?php
include 'top.php';

//to sanitize data from form - server side validation
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
function saniText($field) {
    return(preg_match("/^([[:alnum:]]|-|\.|(|)| |,|%|&|;|#||)+$/i", $field[0]));
}

// pull data from database to initialize variables
$pmkItemNumber = (isset($_GET['itemNum'])) ? htmlspecialchars($_GET['itemNum']) : '';
if(isset($_POST['hiItemNum'])) {
    $pmkItemNumber = htmlspecialchars($_POST['hiItemNum']);
}

const ORDER_DEBUG = false; // debugging constant

// set defaults
$fnkEmployeeEmail = '';
$fldOrderDate = '';
$fnkItemNumber = '';
$fnkItemName = '';
$fnkProjectName = '';
$fldQuantity = '';
$fnkCost = '';
$fnkVendorName = '';

$sql = 'SELECT pmkItemNumber, fldItemName, fldCost, fldDescription, fldVendorName, fldVendorContact, fldCategory, fldItemImage ';
$sql .= 'FROM tblItems WHERE pmkItemNumber = ?';
$data = array($pmkItemNumber);
$items = $thisDatabaseReader->select($sql, $data);

// pulling project names from database for dropdown list on form
$sql2 = 'SELECT pmkProjectName FROM tblProject';
$data2 = '';
$projects = $thisDatabaseReader->select($sql2, $data2);

?>

<!--Display the common name in a heading-->
<main id="updatePage">

    <h2>Ordering
        <?php
        print '<p>Item: ' . $items[0]['fldItemName'] . $items[0]['pmkItemNumber'] . '</p>';
        ?>
    </h2>


<?php
// setting variable values to sanitized inputs from form that have been retrieved from the database
if(isset($_POST['submitBtn'])) {
    $fnkEmployeeEmail = getData('txtEmployeeEmail');
    $fldOrderDate = getData('txtOrderDate');
    $fnkItemNumber = getData('txtItemNumber');
    $fnkItemName = getData('txtItemName');
    $fnkProjectName = getData('txtProjectName');
    $fnkCost = getData('txtItemCost');
    $fnkVendorName = getData('txtVendorName');
    $fldQuantity = getData('txtQuantity');

    $saveData = true;

    //validate inputs from form
    if ($fnkEmployeeEmail == '') {
        print '<p class="mistake">Please enter a valid email address.</p>';
        $saveData = false;
    } elseif (!filter_var($fnkEmployeeEmail, FILTER_VALIDATE_EMAIL)) {
        // filter var returns true if it is valid, the ! says if it is not good
        print '<p class="mistake">Your email address appears to be incorrect.</p>';
        $saveData = false;
    }
    if ($fldOrderDate == '') {
        print '<p class="mistake">Please enter the date.</p>';
        $saveData = false;
    } elseif (!saniText($fldOrderDate)) {
        print '<p class="mistake">Please make sure to only enter numbers for the date.</p>';
        $saveData = false;
    }
    if ($fnkItemNumber == '') {
        print '<p class="mistake">Please enter the item number.</p>';
        $saveData = false;
    } elseif (!saniText($fnkItemNumber)) {
        print '<p class="mistake">Please enter valid text for the item number.</p>';
        $saveData = false;
    }
    if ($fnkItemName == '') {
        print '<p class="mistake">Please enter the item name.</p>';
        $saveData = false;
    } elseif (!saniText($fnkItemName)) {
        print '<p class="mistake">Please enter valid text for the item name.</p>';
        $saveData = false;
    }
    if (!isset($fnkProjectName)) {
        print '<p class="mistake">Please enter the project name.</p>';
        $saveData = false;
    }
    if ($fldQuantity == '') {
        print '<p class="mistake">Please enter the quantity to order.</p>';
        $saveData = false;
    } elseif (!saniText($fldQuantity)) {
        print '<p class="mistake">Please enter valid text for quantity.</p>';
        $saveData = false;
    }
    if ($fnkCost == '') {
        print '<p class="mistake">Please enter the item\'s cost.</p>';
        $saveData = false;
    } elseif (!saniText($fnkCost)) {
        print '<p class="mistake">Please enter valid text for the item\'s cost.</p>';
        $saveData = false;
    }
    if ($fnkVendorName == '') {
        print '<p class="mistake">Please enter the vendor\'s name.</p>';
        $saveData = false;
    } elseif (!saniText($fnkVendorName)) {
        print '<p class="mistake">Please enter valid text for the vendor\'s name.</p>';
        $saveData = false;
    }

    //print '$saveData = ' . $saveData;
// if saveData == true, then prepare the insert statement - have to pass an array of values from form input as 'values' in the insert function
    if ($saveData) {
        $toInsert = array($fnkEmployeeEmail, $fldOrderDate, $fnkItemNumber, $fnkItemName, $fnkProjectName, $fldQuantity, $fnkCost, $fnkVendorName);

        $sql = 'INSERT INTO tblOrders SET ';
        $sql .= 'fnkEmployeeEmail = ?, ';
        $sql .= 'fldOrderDate = ?, ';
        $sql .= 'fnkItemNumber = ?, ';
        $sql .= 'fnkItemName = ?, ';
        $sql .= 'fnkProjectName = ?, ';
        $sql .= 'fldQuantity = ?, ';
        $sql .= 'fnkCost = ?, ';
        $sql .= 'fnkVendorName = ? ';

        $status = $thisDatabaseWriter->insert($sql, $toInsert);
        if ($status) {
            print '<p>Congratulations!!! You\'ve ordered this item!</p>';
        } else {
            '<p>Couldn\'t complete the order. Please contact someone :)</p>';
        }

        //Print the post array if the form is submitted and if DEBUG is set to true
        if (ORDER_DEBUG) {
            print('<p>Pulled from the database:</p><pre>');
            print_r($items);
            print('</pre>');
            print('<p>Ordering POST array:</p><pre>');
            print_r($_POST);
            print('</pre>');
            print('<p>Ordering SQL array:</p><pre>');
            print_r($sql);
            print('</pre>');
        }
    }
}
?>

    <!--Form to order an item-->
    <form action="<?php print PHP_SELF; ?>" id="orderForm" method="POST">
        <fieldset class="orderForm">
            <input type="hidden" value="<?php print $items[0]['pmkItemNumber'] ?>" id="hiItemNum" name="hiItemNum">

            <legend>Please enter your email address</legend>
            <input type="email" id="txtEmployeeEmail" name="txtEmployeeEmail" placeholder="name@some_domain.com" value="<?php if(isset($_POST['txtEmployeeEmail'])) echo $_POST['txtEmployeeEmail'] ?>" maxlength="60" required>

            <p><legend for="txtOrderDate">Today's Date</legend>
                <input type="text" id="txtOrderDate" name="txtOrderDate" placeholder="Today's Date" value="<?php if(!isset($_POST['txtOrderDate'])) print date("Y-m-d"); else print_r($_POST['txtOrderDate']) .
                'required>'; ?>"</p>


            <p><legend for="txtItemNumber">Item Number</legend>
                <input type="text" id="txtItemNumber" name="txtItemNumber" placeholder="Item Number"  value="<?php print $items[0]['pmkItemNumber'] ?>" required></p>

            <p><legend>Enter the item's name</legend></p>
                <input type="text" id="txtItemName" name="txtItemName" placeholder="Item Name" value="<?php print $items[0]['fldItemName'] ?>" required>
            <p></p>
            <fieldset id="project">
                <p><legend>Select a project from the list to apply this order to</legend></p>
                <select name="txtProjectName">
                    <option value="">Select a project</option>
                    <?php
                    foreach($projects as $project) {
                        print '<option value="' . $project['pmkProjectName'] . '">' . $project['pmkProjectName'] . '</option>';
                    }
                    ?>
                </select>
            </fieldset>

            <p><legend>Enter the item's cost in U.S. dollars</legend></p>
            <input type="text" id="txtItemCost" name="txtItemCost" placeholder="Item Cost" value="<?php print $items[0]['fldCost'] ?>" required>

            <p><legend>Enter the vendor's name</legend></p>
            <input type="text" id="txtVendorName" name="txtVendorName" placeholder="Vendor Name" value="<?php print $items[0]['fldVendorName'] ?>" required>

            <p><legend>Enter the quantity to order</legend></p>
            <input type="text" id="txtQuantity" name="txtQuantity" placeholder="Quantity" value="<?php if(isset($_POST['txtQuantity'])) echo $_POST['txtQuantity'] ?>" required>

            <p><input id="submitBtn" type="submit" value="Order Item"  name="submitBtn"</p>
        </fieldset>
    </form>

</main>

<?php
include 'footer.php';
?>
