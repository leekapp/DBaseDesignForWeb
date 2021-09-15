<!--Lee Kapp - CS148 Final - delete an item-->
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
$pmkItemNumber = (isset($_GET['item'])) ? htmlspecialchars($_GET['item']) : '';
if(isset($_POST['hiItemNum'])) {
    $pmkItemNumber = htmlspecialchars($_POST['hiItemNum']);
}

$sql = 'SELECT pmkItemNumber, fldItemName, fldCost, fldDescription, fldVendorName, fldVendorContact, fldCategory, fldItemImage ';
$sql .= 'FROM tblItems WHERE pmkItemNumber = ?';
$data = array($pmkItemNumber);
$items = $thisDatabaseReader->select($sql, $data);
?>

<main id="deletePage">

    <h2>Delete
        <?php
        print '<p>Item: ' . $items[0]['pmkItemNumber'] . '</p>';
        ?>
    </h2>

<?php
if (Del_DEBUG) {
    print('<p>Item to delete:</p><pre>');
    print 'Item: ' . $pmkItemNumber;
    print ' SQL statement: ' .$sql;
    print_r($data);
    print('</pre>');
}

if(isset($_POST['deleteBtn'])) {
    $data = getData('hiItemNumber');

    $sql = 'DELETE FROM tblItems ';
    $sql .= 'WHERE pmkItemNumber = ?';

    $status = $thisDatabaseWriter->delete($sql, $data);
    if($status){
        //print '<a href="confPage.php"' . '>';
        print '<p>Success! You\'ve deleted this item from tblItems.</p>';
    } else {
        print '<p>Couldn\'t complete the deletion. Please check that your information is correct :(</p>';
    }
}
?>
    <!--Form to delete a project from tblProject-->
    <form action="<?php print PHP_SELF; ?>" id="deleteRecord" method="POST">
        <fieldset class="delete">
            <input type="hidden" value="<?php print $items[0]['pmkItemNumber'] ?>" id="hiItemNumber" name="hiItemNumber">
            <p>Press the delete button if you are certain that you want to delete this item from tblItems</p>
            <p><input id="deleteBtn" type="submit" value="Delete Record"  name="deleteBtn"</p>
        </fieldset>
    </form>
</main>

<?php
include 'adFooter.php';
?>
