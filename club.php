<?php
// Retrieve POST data
$Fname = $_POST['fullName'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$ctctNumber = $_POST['contactNumber'];
$mail = $_POST['email'];
$experienced = $_POST['experience'];
$experience_detls = $_POST['details'];
$role = $_POST['role'];
$batting_style = $_POST['battingStyle'];
$bowling_style = $_POST['bowlingStyle'];
$fitness = $_POST['fit'];
$injury = $_POST['injuries'];
$injury_detls = $_POST['injuryDetails'];
$availability = $_POST['availability'];

// Database connection
$con = mysqli_connect("localhost", "root", "", "taglinesportsclub");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Use prepared statements to prevent SQL injection
$sql = "INSERT INTO player_details (
    Full_Name, Date_Of_Birth,Address, Contact_Number, E_mail, Experienced, 
    Experience_Details, player_Role, Batting_Style, Bowling_Style, Fitness, 
    Injuries, Details_Of_injuries, Availability_For_practice
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssssssssssss", $Fname, $dob, $address, $ctctNumber, $mail, $experienced, $experience_detls, $role, $batting_style, $bowling_style, $fitness, $injury, $injury_detls, $availability);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Data Inserted Successfully.";
    } else {
        echo "Error occurred: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Failed to prepare the SQL statement: " . mysqli_error($con);
}

// Close the connection
mysqli_close($con);
?>
