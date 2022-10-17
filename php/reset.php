<?php
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = resetPassword($email, $password);
    if($result == true){
        echo "Password was changed successfully!";
        echo "<br><br><a href='../forms/login.html'>Log In</a>";
    } else {
        echo "User does not exist";
        echo "<br><br><a href='../forms/resetpassword.html'>Try again</a>";
    }
}

function resetPassword($email, $password){
    $success = false;
    $csvf = "../storage/users.csv";
    $csvr = '../storage/temporary.csv';
    $csv = fopen($csvf, "r");
    $cvv = fopen($csvr, 'w');
    $count = 0;
    while (($data = fgetcsv($csv)) !== FALSE) {
        if ($data[1] == $email) {
            $data[2] = $password;
            $count++;
        }
        fputcsv($cvv, $data);
    }
    fclose($csv);
    fclose($cvv);

    unlink($csvf); // Delete old database and replace with databaase with new password
    rename($csvr, $csvf);

    if($count > 0){
        $success = true;
    }
    
    return $success;
}
// echo "HANDLE THIS PAGE";


