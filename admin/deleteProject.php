<!--Lee Kapp - CS148 Final - delete a project-->
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
$pmkProjectName = (isset($_GET['project'])) ? htmlspecialchars($_GET['project']) : '';
if(isset($_POST['hiProjectName'])) {
    $pmkProjectName = htmlspecialchars($_POST['hiProjectName']);
}

//set defaults and pull from the database
$fldFundingSource = '';

$sql =  'SELECT pmkProjectName, fldFundingSource FROM tblProject WHERE pmkProjectName = ?';
$data = array($pmkProjectName);
$projects = $thisDatabaseReader->select($sql, $data);
?>

<main id="deletePage">
    <h2>Delete
        <?php print($pmkProjectName);
        print '<p>Project: ' . $pmkProjectName . '</p>';
        ?>
    </h2>

    <?php
    if (Del_DEBUG) {
    print('<p>Project to delete:</p><pre>');
        print 'Project: ' . $pmkProjectName;
        print ' SQL statement: ' .$sql;
        print_r($data);
        print('</pre>');
    }

    if(isset($_POST['deleteBtn'])) {
        $data = getData('hiProjectName');

        $sql = 'DELETE FROM tblProject ';
        $sql .= 'WHERE pmkProjectName = ?';

        $status = $thisDatabaseWriter->delete($sql, $data);
        if($status){
            //print '<a href="confPage.php"' . '>';
            print '<p>Success! You\'ve deleted this project from tblProject.</p>';
        } else {
            print '<p>Couldn\'t complete the deletion. Please check that your information is correct :(</p>';
        }
    }
    ?>

    <!--Form to delete a project from tblProject-->
    <form action="<?php print PHP_SELF; ?>" id="deleteRecord" method="POST">
        <fieldset class="delete">
            <input type="hidden" value="<?php print $projects[0]['pmkProjectName'] ?>" id="hiProjectName" name="hiProjectName">
            <p>Press the delete button if you are certain that you want to delete this project from tblProject</p>
            <p><input id="deleteBtn" type="submit" value="Delete Record"  name="deleteBtn"</p>
        </fieldset>
    </form>
</main>

<?php
include 'adFooter.php';
?>

