<?php
session_start();
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = loginUser($email, $password);

    //echo "$email $password, $result";
    if ($result == true) {
        echo "Login Successful!";
        echo "<br><br><a href='../dashboard.php'>Go Dashboard</a>";
    } else {
        echo "Incorrect password or email!";
        echo "<br><br><a href='../forms/login.html'>Try again</a>";
    }
}

function loginUser($email, $password){
    $success = false;
    $csvf = "../storage/users.csv";
    $csv = fopen($csvf, "r");
    
    while (($data = fgetcsv($csv)) !== FALSE) {
        if ($data[1] == $email && $data[2] == $password) {
            $_SESSION['user'] = $data[0];
            $success = true;
            return $success;
        }
    }

    fclose($csv);
    
    return $success;
}

// echo "HANDLE THIS PAGE";

