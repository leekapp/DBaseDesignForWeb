<!--Lee Kapp - CS148 Final - form to insert a new personnel record-->
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

const INS_DEBUG = false;

// set defaults
$pmkEmployeeEmail = '';
$fldEmployeeFName = '';
$fldEmployeeLName = '';
$fldJobTitle = '';
?>

<main id="personInsertPage">

<?php
//Print the post array if the form is submitted and if DEBUG is set to true
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

    // if saveData == true, then prepare the insert statement - have to pass an array of values from form input as 'values' in the insert function
    if ($saveData) {
        $toInsert = array($pmkEmployeeEmail, $fldEmployeeFName, $fldEmployeeLName, $fldJobTitle);
        $sql = 'INSERT INTO tblPersonnel (pmkEmployeeEmail, fldEmployeeFName, fldEmployeeLName, fldJobTitle) ';
        $sql .= 'VALUES (?, ?, ?, ?)';


        $status = $thisDatabaseWriter->insert($sql, $toInsert);
        if ($status) {
            print '<p>Success! You\'ve entered this employee\'s information into tblPersonnel.</p>';
        } else {
            '<p>Couldn\'t complete the insertion. Please check that your information is correct :(</p>';
        }

        if (INS_DEBUG) {
            print('<p>POST array:</p><pre>');
            print_r($_POST);
            print('</pre>');
        }
    }
}
?>

<!--Form to insert a new record into table personnel-->
<form action="<?php print PHP_SELF; ?>" id="insertRecord" method="POST">
    <fieldset class="insert">
        <legend>Please enter the employee's email address</legend>
        <input type="email" id="txtEmployeeEmail" name="txtEmployeeEmail" placeholder="name@some_domain.com" maxlength="60" value="<?php if(isset($_POST['txtEmployeeEmail'])) echo $_POST['txtEmployeeEmail'] ?>" required>

        <p><legend>Enter the employee's first name</legend></p>
        <input type="text" id="txtEmployeeFName" name="txtEmployeeFName" placeholder="Employee First Name" value="<?php if(isset($_POST['txtEmployeeFName'])) echo $_POST['txtEmployeeFName'] ?>" required></p>

        <p><legend>Enter the employee's last name</legend></p>
        <input type="text" id="txtEmployeeLName" name="txtEmployeeLName" placeholder="Employee Last Name" value="<?php if(isset($_POST['txtEmployeeLName'])) echo $_POST['txtEmployeeLName'] ?>" required></p>

        <fieldset id="jobtitle">
            <legend>Select the employee's position</legend>
            <p><input type="radio" name="txtJobTitle" id="PI" value="Principal Investigator">&nbsp;&nbsp;
                <label for="PI">Principal&nbsp;Investigator</label></p>
            <p><input type="radio" name="txtJobTitle" id="technician" value="Technician">&nbsp;&nbsp;
                <label for="technician">Technician</label></p>
            <p><input type="radio" name="txtJobTitle" id="grad_student" value="Graduate Student">&nbsp;&nbsp;
                <label for="grad_student">Graduate Student</label></p>
            <p><input type="radio" name="txtJobTitle" id="post_doc" value="Post-Doc">&nbsp;&nbsp;
                <label for="post_doc">Post Doc</label></p>
            <p><input type="radio" name="txtJobTitle" id="researcher" value="Researcher">&nbsp;&nbsp;
                <label for="researcher">Researcher</label></p>
            <p><input type="radio" name="txtJobTitle" id="administrator" value="Administrator">&nbsp;&nbsp;
                <label for="administrator">Administrator</label></p>
        </fieldset>
    <p><input id="submitbtn" type="submit" value="Insert Record"  name="submitBtn"</p>
    </fieldset>
</form>

</main>

<?php
include 'adFooter.php';
?>

