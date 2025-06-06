<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "include/header.inc";?>
    <title>EOI Received - SegFault Services</title>
</head>

<body>
    <!-- Header with aside logo and navbar -->
    <?php include "include/navbar.inc";?>
    <!-- end of header -->

    <section class="slideshow center-flex">
        <h1>EOI Received</h1>
    </section>

<?php

include "include/die_with_footer.inc";

// Restrict direct access to processEOI.php file from browser
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: apply.php');
    exit();
}
// Add DB connection
require_once "settings.php";

// CREATE gender table if it doesn't already exist
$createGender = <<<SQL
CREATE TABLE IF NOT EXISTS gender (
    gender_id INT AUTO_INCREMENT PRIMARY KEY,
    gender_label VARCHAR(20) NOT NULL
);
SQL;

// Check table creation successful
mysqli_query($conn, $createGender) or die_with_footer("Gender table creation failed: " . mysqli_error($conn));

// Populate gender if empty
$genderCheck = mysqli_query($conn, "SELECT COUNT(*) as count FROM gender");
$genderRow = mysqli_fetch_assoc($genderCheck);
if ((int)$genderRow['count'] === 0) {
    mysqli_query($conn, "
        INSERT INTO gender (gender_id, gender_label) VALUES
        (1, 'Male'), (2, 'Female'), (3, 'Other')
    ");
}

// CREATE states table if it doesn't already exist
$createStates = <<<SQL
CREATE TABLE IF NOT EXISTS states (
    state_id INT AUTO_INCREMENT PRIMARY KEY,
    state_code VARCHAR(3) NOT NULL,
    state_name VARCHAR(30) NOT NULL
);
SQL;

mysqli_query($conn, $createStates) or die_with_footer("States table creation failed: " . mysqli_error($conn));

// Populate states if table is empty
$statesCheck = mysqli_query($conn, "SELECT COUNT(*) as count FROM states");
$statesRow = mysqli_fetch_assoc($statesCheck);
if ((int)$statesRow['count'] === 0) {
    mysqli_query($conn, "
        INSERT INTO states (state_id, state_code, state_name) VALUES
        (1, 'VIC', 'Victoria'),
        (2, 'NSW', 'New South Wales'),
        (3, 'QLD', 'Queensland'),
        (4, 'NT',  'Northern Territory'),
        (5, 'WA',  'Western Australia'),
        (6, 'SA',  'South Australia'),
        (7, 'TAS', 'Tasmania'),
        (8, 'ACT', 'Australian Capital Territory')
    ");
}

// CREATE status table if it doesn't already exist
$createstatus = <<<SQL
CREATE TABLE IF NOT EXISTS status (
    status_id INT AUTO_INCREMENT PRIMARY KEY,
    status_label VARCHAR(10) NOT NULL
);
SQL;

mysqli_query($conn, $createstatus) or die_with_footer("status table creation failed: " . mysqli_error($conn));

// Populate status if empty
$statusCheck = mysqli_query($conn, "SELECT COUNT(*) as count FROM status");
$statusRow = mysqli_fetch_assoc($statusCheck);
if ((int)$statusRow['count'] === 0) {
    mysqli_query($conn, "
        INSERT INTO status (status_id, status_label) VALUES
        (1, 'New'), (2, 'Current'), (3, 'Final')
    ");
}

// CREATE eoi table if it doesn't already exist
$createTable = <<<SQL
CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    jobRefNo VARCHAR(5) NOT NULL,
    firstName VARCHAR(20) NOT NULL,
    lastName VARCHAR(20) NOT NULL,
    DOB DATE NOT NULL,
    gender INT NOT NULL,
    othergender VARCHAR(20),
    address VARCHAR(40) NOT NULL,
    suburb VARCHAR(40) NOT NULL,
    state INT NOT NULL,
    postcode INT(4) UNSIGNED NOT NULL,
    phonenumber VARCHAR(15) NOT NULL,
    email VARCHAR(40) NOT NULL,
    skill_java TINYINT(1) NOT NULL DEFAULT 0,
    skill_cpp TINYINT(1) NOT NULL DEFAULT 0,
    skill_php TINYINT(1) NOT NULL DEFAULT 0,
    skill_sql TINYINT(1) NOT NULL DEFAULT 0,
    skill_python TINYINT(1) NOT NULL DEFAULT 0,
    skill_other TINYINT(1) NOT NULL DEFAULT 0,
    skill_other_details TEXT,
    status INT NOT NULL DEFAULT 1,
    FOREIGN KEY (gender) REFERENCES gender(gender_id),
    FOREIGN KEY (state) REFERENCES states(state_id),
    FOREIGN KEY (status) REFERENCES status(status_id)
);
SQL;

// Display error if table doesn't create cleanly
mysqli_query($conn, $createTable) or die_with_footer("Table creation error: " . mysqli_error($conn));

include "include/sanitise_input_function.inc";

// Retrieve and sanitize inputs
$jobRefNo = sanitise_input("jobRefNo");
$firstName = sanitise_input("firstName");
$lastName = sanitise_input("lastName");
$DOB = sanitise_input("DOB");
$gender = isset($_POST['gender']) ? (int) $_POST['gender'] : 0;
$othergender = ($gender == 3) ? sanitise_input("othergender") : '';
$address = sanitise_input("address");
$suburb = sanitise_input("suburb");
$stateCode = sanitise_input("state"); // e.g., 'VIC'
$postcode = sanitise_input("postcode");
$email = sanitise_input("email");
$phonenumber = sanitise_input("phonenumber");
$skill_other = isset($_POST['skill_other_details']) ? sanitise_input("skill_other_details") : '';
$skills = [
    'skill_java' => isset($_POST['skill_java']) ? 1 : 0,
    'skill_cpp' => isset($_POST['skill_cpp']) ? 1 : 0,
    'skill_php' => isset($_POST['skill_php']) ? 1 : 0,
    'skill_sql' => isset($_POST['skill_sql']) ? 1 : 0,
    'skill_python' => isset($_POST['skill_python']) ? 1 : 0
];
$skill_other_details = ($skill_other && isset($_POST['skill_other_details'])) ? sanitise_input("skill_other_details") : "";

// Validation rules
if (!preg_match('/^[A-Za-z0-9]{5}$/', $jobRefNo)) die_with_footer("Job Ref invalid.");
if (!preg_match('/^[A-Za-z]{1,20}$/', $firstName)) die_with_footer("Invalid First Name.");
if (!preg_match('/^[A-Za-z]{1,20}$/', $lastName)) die_with_footer("Invalid Last Name.");
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $DOB)) die_with_footer("DOB must be in dd/mm/yyyy format.");
if (!in_array($gender, [1, 2, 3])) die_with_footer("Invalid gender selected.");

// DOB Management
$DOB_parts = explode('/', $DOB);
if (count($DOB_parts) !== 3 || !checkdate($DOB_parts[1], $DOB_parts[0], $DOB_parts[2])) die_with_footer("Invalid DOB.");
$DOB_mysql = "{$DOB_parts[2]}-{$DOB_parts[1]}-{$DOB_parts[0]}";
$age = (int)date('Y') - (int)$DOB_parts[2];
if ($age < 15 || $age > 80) die_with_footer("Invalid age. Must be between 15 - 80.");

// Email and phonenumber
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) die_with_footer("Invalid email.");
if (!preg_match('/^[0-9 ]{8,12}$/', $phonenumber)) die_with_footer("Invalid phonenumber.");

// State code to ID
$state_map = ['VIC'=>1,'NSW'=>2,'QLD'=>3,'NT'=>4,'WA'=>5,'SA'=>6,'TAS'=>7,'ACT'=>8];
if (!isset($state_map[$stateCode])) die_with_footer("Invalid state.");
$state_id = $state_map[$stateCode];

// Check postcode matches state -- Marcus
// Function to check if a value is between two other values
function between($value, $min, $max){
    return ($value >= $min && $value <= $max);
}
$invalidpostcode_msg = "Postcode and state do not match.";
switch ($state_id) {
    case 1: // Victoria
        if(between($postcode, 3000, 3996) 
        || between($postcode, 8000, 8999)){
            break;
        } else die_with_footer($invalidpostcode_msg);
    case 2: // New South Wales
        if(between($postcode, 1000, 1999) 
        || between($postcode, 2000, 2599)
        || between($postcode, 2619, 2899)
        || between($postcode, 2921, 2999)){
            break;
        } else die_with_footer($invalidpostcode_msg);
    case 3: // Queensland
        if(between($postcode, 4000, 4999)
        || between($postcode, 9000, 9999)){
            break;
        } else die_with_footer($invalidpostcode_msg);
    case 4: // Northern Territory
        if(between($postcode, 800, 999)){
            break;
        } else die_with_footer($invalidpostcode_msg);
    case 5: // Western Australia
        if(between($postcode, 6000, 6797)
        || between($postcode, 6800, 6999)){
            break;
        } else die_with_footer($invalidpostcode_msg);
    case 6: // South Australia
        if(between($postcode, 5000, 5999)){
            break;
        } else die_with_footer($invalidpostcode_msg);
    case 7: // Tasmania
        if(between($postcode, 7000, 7999)){
            break;
        } else die_with_footer($invalidpostcode_msg);
    case 8: // Australian Capital Territory
        if(between($postcode, 200, 299)
        || between($postcode, 2600, 2618)
        || between($postcode, 2900, 2920)){
            break;
        } else die_with_footer($invalidpostcode_msg);
    default:
        die_with_footer($invalidpostcode_msg);
        break;
}

// Other skill
if ($skill_other && empty($skill_other))
if (!empty($_POST['skill_other_details']) && empty($skill_other)) die_with_footer("Please specify 'other' skill.");
$skill_other = isset($_POST['skill_other']) ? 1 : 0;

// Set status default
$status = 1;

//
$stmt = $conn->prepare("INSERT INTO eoi (
    jobRefNo, firstName, lastName, DOB, gender, othergender,
    address, suburb, state, postcode, phonenumber, email,
    skill_java, skill_cpp, skill_php, skill_sql, skill_python, skill_other, skill_other_details, status
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) die_with_footer("Prepare failed: " . $conn->error);

// Prepare SQL query to send values to the db placeholder locations
$stmt->bind_param("ssssisssiissiiiiissi",
    $jobRefNo, $firstName, $lastName, $DOB_mysql, $gender, $othergender,
    $address, $suburb, $state_id, $postcode, $phonenumber, $email,
    $skills['skill_java'], $skills['skill_cpp'], $skills['skill_php'],
    $skills['skill_sql'], $skills['skill_python'], $skill_other, $skill_other_details, $status
);

// Execute the SQL insertion or return error
$stmt->execute() or die_with_footer("Insert failed: " . $stmt->error);
$eoiNumber = $stmt->insert_id;
?>

    <section class="focus"> <!--Content Section-->
        <h1><span class="terminalblink">_</span>Thank you for your application!</h1>
        <p>Your application has been received. Your EOI number is: <strong><?php echo "$eoiNumber";?></strong></p>
    </section>


    <!-- Footer -->
    <?php include "include/footer.inc";?>

</body>
</html>