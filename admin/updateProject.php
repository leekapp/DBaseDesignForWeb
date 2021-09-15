<!--Lee Kapp - CS148 Final - form to update a project record-->
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

<main id="updatePage">

    <h2>Updating
        <?php
        print '<p>Project: ' . $projects[0]['pmkProjectName'] . '</p>';
        ?>
    </h2>


<?php
// setting variable values to sanitized inputs from form that have been retrieved from the database
if(isset($_POST['submitBtn'])) {
    $pmkProjectName = getData('txtProjectName');
    $fldFundingSource = getData('txtFundingSource');

    $saveData = true;

    if ($pmkProjectName = '') {
        print '<p class="mistake">Please enter a project name.</p>';
        $saveData = false;
    } else if (!saniText($pmkProjectName)) {
        print '<p class="mistake">Please make sure to only enter valid text for the project name.</p>';
        $saveData = false;
    }
    if ($fldFundingSource = '') {
        print '<p class="mistake">Please enter a funding source.</p>';
        $saveData = false;
    } else if (!saniText($fldFundingSource)) {
        print '<p class="mistake">Please make sure to only enter valid text for the funding source.</p>';
        $saveData = false;
    }
    // set values of the update array to the sanitized values from the form
    if ($saveData) {
        $toUpdate = array();
        $toUpdate[] = $pmkProjectName;
        $toUpdate[] = $fldFundingSource;

        $sql = 'UPDATE tblProject SET ';
        $sql .= 'fldFundingSource = ? ';
        $sql .= 'WHERE pmkProjectName = ?';

        $status = $thisDatabaseWriter->update($sql, $toUpdate);

        if ($status) {
            print '<p>Success! You\'ve updated this project.</p>';
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
<main class="projectUpdatePage">

    <!--Form to insert a new record into table category-->
    <form action="<?php print PHP_SELF; ?>" id="updateRecord" method="POST">
        <fieldset class="update">
            <input type="hidden" value="<?php print $projects[0]['pmkProjectName'] ?>" id="hiProjectName" name="hiProjectName">

            <p><legend>Enter a project name</legend></p>
            <input type="text" id="txtProjectName" name="txtProjectName" placeholder="Project Name" value="<?php print $projects[0]['pmkProjectName'] . PHP_EOL; ?>" required>

            <p><legend>Enter the name of the funding source</legend></p>
            <input type="text" id="txtFundingSource" name="txtFundingSource" placeholder="Funding Source for Project" value="<?php print $projects[0]['fldFundingSource'] . PHP_EOL; ?>" required>

            <p><input id="submitBtn" type="submit" value="Update Record"  name="submitBtn"</p>
        </fieldset>
    </form>
</main>

<?php
include 'adFooter.php';
?>

