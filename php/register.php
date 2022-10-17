<?php
if(isset($_POST['submit'])){
    $username = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

registerUser($username, $email, $password);

}

function registerUser($username, $email, $password){
    //save data into the file
    $csvFile = "../storage/users.csv";
    if (!file_exists($csvFile)) { //check if file exists, so can be read from
        touch($csvFile); //create if it does not exist
    }

    $csvHead = fopen($csvFile, "r");
    if(!($csvData = fgetcsv($csvHead))) { //check if header exist in csv file
        fclose($csvHead);
        $csvHead = fopen($csvFile, 'w');
        fputcsv($csvHead,  ['Username','Email Address','Password']);
        fclose($csvHead); 
    }

    $csvData = fopen($csvFile, 'a'); //append new data to csv table
    if(fputcsv($csvData,  [$username, $email, $password])){ 
        echo "User Successfully registered!";
        fclose($csvData);
        echo "<br><br><a href='../forms/login.html'>Log In</a>";
        // header('location: ../forms/login.html');
    } else {
        echo "Something went wrong, try again!";
        fclose($csvData);
        echo "<br><br><a href='../index.php'>Go back</a>";
        //header('location: ../forms/register.html');
    }
   
}
// echo "HANDLE THIS PAGE";



