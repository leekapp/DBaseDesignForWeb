<!--Lee Kapp - CS148 Final - delete a person-->
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
$pmkEmployeeEmail = (isset($_GET['person'])) ? htmlspecialchars($_GET['person']) : '';
if(isset($_POST['hiEmpEmail'])) {
    $pmkEmployeeEmail = htmlspecialchars($_POST['hiEmpEmail']);
}

//set defaults and pull from the database
$fldEmployeeFName = '';
$fldEmployeeLName = '';
$fldJobTitle = '';

$sql =  'SELECT pmkEmployeeEmail, fldEmployeeFName, fldEmployeeLName, fldJobTitle FROM tblPersonnel WHERE pmkEmployeeEmail = ?';
$data = array($pmkEmployeeEmail);
$people = $thisDatabaseReader->select($sql, $data);
?>

<main id="deletePage">

    <h2>Delete
        <?php
        print '<p>Person: ' . $people[0]['fldEmployeeFName'] . '</p>';
        ?>
    </h2>

<?php
    if (Del_DEBUG) {
    print('<p>Person to delete:</p><pre>');
        print 'Person: ' . $pmkEmployeeEmail;
        print ' SQL statement: ' .$sql;
        print_r($data);
        print('</pre>');
    }

if(isset($_POST['deleteBtn'])) {
    $data = getData('hiEmpEmail');

    $sql = 'DELETE FROM tblPersonnel ';
    $sql .= 'WHERE pmkEmployeeEmail = ?';

    $status = $thisDatabaseWriter->delete($sql, $data);
    if($status){
        //print '<a href="confPage.php"' . '>';
        print '<p>Success! You\'ve deleted this person from tblPersonnel.</p>';
    } else {
        print '<p>Couldn\'t complete the deletion. Please check that your information is correct :(</p>';
    }
}
?>

    <!--Form to delete a project from tblProject-->
    <form action="<?php print PHP_SELF; ?>" id="deleteRecord" method="POST">
        <fieldset class="delete">
            <input type="hidden" value="<?php print $people[0]['pmkEmployeeEmail'] ?>" id="hiEmpEmail" name="hiEmpEmail">
            <p>Press the delete button if you are certain that you want to delete this person from tblPersonnel</p>
            <p><input id="deleteBtn" type="submit" value="Delete Record"  name="deleteBtn"</p>
        </fieldset>
    </form>
</main>

<?php
include 'adFooter.php';
?>
