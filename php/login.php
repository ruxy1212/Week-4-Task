<?php
session_start();
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = loginUser($email, $password);

    //echo "$email $password, $result";
    if ($result) {
        echo "<script type='text/javascript'>
                alert('Login Successful!');
                window.location = '../dashboard.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Incorrect password or email!');
                window.location = '../forms/login.html';
            </script>";
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

