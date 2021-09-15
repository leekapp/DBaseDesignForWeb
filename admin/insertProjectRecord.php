<!--Lee Kapp - CS148 Final - form to insert a new project record-->
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
$fldProjectName = '';
$fldFundingSource = '';

?>

<main id="projectInsertPage">

    <?php
    //Print the post array if the form is submitted and if DEBUG is set to true
    if(isset($_POST['submitBtn'])) {
        $fldProjectName = getData('txtProjectName');
        $fldFundingSource = getData('txtFundingSource');
        $saveData = true;

        if ($fldProjectName = '') {
            print '<p class="mistake">Please enter a project name.</p>';
            $saveData = false;
        } else if (!saniText($fldProjectName)) {
            print '<p class="mistake">Please make sure to only enter valid text for the project name.</p>';
            $saveData = false;
        }
        if (!isset($_POST['txtFundingSource'])) {
            print '<p class="mistake">Please select a funding source.</p>';
            $saveData = false;
        } else if (!saniText($fldFundingSource)) {
            print '<p class="mistake">Please make sure to only enter valid text for the funding source.</p>';
            $saveData = false;
        }

        // if saveData == true, then prepare the insert statement - have to pass an array of values from form input as 'values' in the insert function
        if ($saveData) {
            $toInsert = array($fldProjectName, $fldFundingSource);

            $sql = 'INSERT INTO tblCategory (fldProjectName, fldFundingSource) ';
            $sql .= 'VALUES (?, ?)';

            $status = $thisDatabaseWriter->insert($sql, $toInsert);
            if ($status) {
                print '<p>Success! You\'ve entered this project\'s information into tblProject.</p>';
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

    <!--Form to insert a new record into table project-->
    <form action="<?php print PHP_SELF; ?>" id="insertRecord" method="POST">
        <fieldset class="insert">
            <p><legend>Enter a project name</legend></p>
            <input type="text" id="txtProjectName" name="txtProjectName" placeholder="Project Name" value="<?php if(isset($_POST['txtProjectName'])) echo $_POST['txtProjectName'] ?>" required>

            <p><legend>Enter the project's funding source</legend></p>
            <input type="text" id="txtFundingSource" name="txtFundingSource" placeholder="Funding Source" value="<?php if(isset($_POST['txtFundingSource'])) echo $_POST['txtFundingSource'] ?>" required>

            <p><input id="submitbtn" type="submit" value="Insert Record"  name="submitBtn"</p>
        </fieldset>
    </form>

</main>

<?php
include 'adFooter.php';
?>

