<!--Lee Kapp - CS148 Final - delete an order-->
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
$pmkOrderNumber = (isset($_GET['orderNum'])) ? (int) htmlspecialchars($_GET['orderNum']) : 0;
if(isset($_POST['hiOrderNum'])) $pmkOrderNumber = (int) htmlspecialchars($_POST['hiOrderNum']);

$sql =  'SELECT * FROM tblOrders WHERE pmkOrderNumber = ? ';

$data = array($pmkOrderNumber);

$orders = $thisDatabaseReader->select($sql, $data);

$pmkOrderNumber = $orders[0]['pmkOrderNumber'];

?>

<main id="deletePage">

    <h2>Delete
        <?php
        print '<p>Order: ' . $orders[0]['pmkOrderNumber'] . ' ' . $orders[0]['fnkEmployeeEmail'] . ' ' . $orders[0]['fldOrderDate'] . ' ' . $orders[0]['fnkItemName'] . ' '. $orders[0]['fnkProjectName'] . '?</p>';
        ?>
    </h2>

    <?php
    if (Del_DEBUG) {
    print('<p>Order to delete:</p><pre>');
        print_r($orders);
        print '<pre>';
        print ('<p>SQL statement:</pre>');
        print_r($sql);
        print('</pre>');
    print ('<p>Data:</pre>');
        print_r($data);
        print('</pre>');
        }

    if(isset($_POST['deleteBtn'])) {
        $data = getData('hiOrderNum');
        $sql = 'DELETE FROM tblOrders ';
        $sql.= 'WHERE pmkOrderNumber = ?';

        $status = $thisDatabaseWriter->delete($sql, $data);
        if($status){
            print '<p>Success! You\'ve deleted this order from tblOrders.</p>';
        } else {
            print '<p>Couldn\'t complete the deletion. Please check that your information is correct :(</p>';
        }
    }
?>
    <!--Form to delete a project from tblProject-->
    <form action="<?php print PHP_SELF; ?>" id="deleteRecord" method="POST">
        <fieldset class="delete">
            <input type="hidden" value="<?php print $orders[0]['pmkOrderNumber'] ?>" id="hiOrderNum" name="hiOrderNum">
            <p>Press the delete button if you are certain that you want to delete this order from tblOrders</p>
            <p><input id="deleteBtn" type="submit" value="Delete Order"  name="deleteBtn"</p>
        </fieldset>
    </form>
</main>

<?php
include 'adFooter.php';
?>