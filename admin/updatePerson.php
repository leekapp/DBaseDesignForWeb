<!--Lee Kapp - CS148 Final - form to update a personnel record-->
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

<main id="updatePage">

    <h2>Updating
        <?php
        print '<p>Person: ' . $people[0]['fldEmployeeFName'] . '</p>';
        ?>
    </h2>

<?php
// setting variable values to sanitized inputs from form that have been retrieved from the database
if(isset($_POST['submitBtn'])) {
    $pmkEmployeeEmail = filter_var($_POST['txtEmployeeEmail'], FILTER_SANITIZE_EMAIL);
    $fldEmployeeFName = getData('txtEmployeeFName');
    $fldEmployeeLName = getData('txtEmployeeLName');
    $fldJobTitle = getData('txtJobTitle');

    $saveData = true;

    if($pmkEmployeeEmail == '') {
        print '<p class="mistake">Please enter a valid email address.</p>';
        $saveData = false;
    } else if (!filter_var($pmkEmployeeEmail, FILTER_VALIDATE_EMAIL)) {
        // filter var returns true if it is valid, the ! says if it is not good
        print '<p class="mistake">The email address appears to be incorrect.</p>';
        $saveData = false;
    }
    if (!saniText($pmkEmployeeEmail)) {
        print '<p class="mistake">Please make sure to only enter a valid email address.</p>';
        $saveData = false;
    }
    if ($fldEmployeeFName = '') {
        print '<p class="mistake">Please enter a first name.</p>';
        $saveData = false;
    } else if (!saniText($fldEmployeeFName)) {
        print '<p class="mistake">Please make sure to only enter valid text for employee\'s first name.</p>';
        $saveData = false;
    }
    if ($fldEmployeeLName = '') {
        print '<p class="mistake">Please enter a last name.</p>';
        $saveData = false;
    } else if (!saniText($fldEmployeeLName)) {
        print '<p class="mistake">Please make sure to only enter valid text for employee\'s last name.</p>';
        $saveData = false;
    }
    if (!isset($_POST['txtJobTitle'])) {
        print '<p class="mistake">Please select the employees position.</p>';
        $saveData = false;
    }

// set values of the update array to the sanitized values from the form
    if ($saveData) {
        $toUpdate = array();
        $toUpdate[] = $pmkEmployeeEmail;
        $toUpdate[] = $fldEmployeeFName;
        $toUpdate[] = $fldEmployeeLName;
        $toUpdate[] = $fldJobTitle;

        $sql = 'UPDATE tblPersonnel SET ';
        $sql .= 'fldEmployeeFName = ?, ';
        $sql .= 'fldEmployeeLName = ?, ';
        $sql .= 'fldJobTitle = ? ';
        $sql .= 'WHERE pmkEmployeeEmail = ?';

        $status = $thisDatabaseWriter->update($sql, $toUpdate);

        if ($status) {
            print '<p>Success! You\'ve updated this personnel record.</p>';
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

<main class="personUpdatePage">
<!--Form to insert a new record into table personnel-->
<form action="<?php print PHP_SELF; ?>" id="updateRecord" method="POST">
    <fieldset class="update">
        <input type="hidden" value="<?php print $people[0]['pmkEmployeeEmail'] ?>" id="hiEmpEmail" name="hiEmpEmail">

        <legend>Please enter the employee's email address</legend>
        <input type="email" id="txtEmployeeEmail" name="txtEmployeeEmail" placeholder="name@some_domain.com" maxlength="60" value="<?php print $people[0]['pmkEmployeeEmail'] ?>" required>

        <p><legend>Enter the employee's first name</legend></p>
        <input type="text" id="txtEmployeeFName" name="txtEmployeeFName" placeholder="Employee First Name" value="<?php print $people[0]['fldEmployeeFName'] ?>" required>

        <p><legend>Enter the employee's last name</legend></p>
        <input type="text" id="txtEmployeeLName" name="txtEmployeeLName" placeholder="Employee Last Name" value="<?php print $people[0]['fldEmployeeLName'] ?>" required>

        <fieldset id="jobtitle">
            <legend>Select the employee's position</legend>
            <p><input type="radio" name="txtJobTitle" id="PI" value="Principal Investigator" <?php echo (isset($_POST['txtJobTitle']) && 'txtJobTitle' == 'Principal Investigator') ? 'checked="checked"' : ''; ?>>
                <label for="PI">Principal&nbsp;Investigator</label></p>
            <p><input type="radio" name="txtJobTitle" id="technician" value="Technician" <?php echo (isset($_POST['txtJobTitle']) && 'txtJobTitle' == 'Technician') ? 'checked="checked"' : ''; ?>>&nbsp;&nbsp;
                <label for="vhazy">Technician</label></p>
            <p><input type="radio" name="txtJobTitle" id="grad_student" value="Graduate Student" <?php echo (isset($_POST['txtJobTitle']) && 'txtJobTitle' == 'Graduate Student') ? 'checked="checked"' : ''; ?>>&nbsp;&nbsp;
                <label for="gradStudent">Graduate Student</label></p>
            <p><input type="radio" name="txtJobTitle" id="post_doc" value="Post-Doc" <?php echo (isset($_POST['txtJobTitle']) && 'txtJobTitle' == 'Post-Doc') ? 'checked="checked"' : ''; ?>>&nbsp;&nbsp;
                <label for="gradStudent">Post Doc</label></p>
            <p><input type="radio" name="txtJobTitle" id="researcher" value="Researcher" <?php echo (isset($_POST['txtJobTitle']) && 'txtJobTitle' == 'Researcher') ? 'checked="checked"' : ''; ?>>&nbsp;&nbsp;
                <label for="researcher">Researcher</label></p>
            <p><input type="radio" name="txtJobTitle" id="administrator" value="Administrator" <?php echo (isset($_POST['txtJobTitle']) && 'txtJobTitle' == 'Administrator') ? 'checked="checked"' : ''; ?>>&nbsp;&nbsp;
                <label for="administrator">Administrator</label></p>
        </fieldset>
        <p><input id="submitbtn" type="submit" value="Update Record"  name="submitBtn"</p>
    </fieldset>
</form>

</main>

<?php
include 'adFooter.php';
?>


