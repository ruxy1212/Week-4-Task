<?php
if(isset($_POST['submit'])){
    $username = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = registerUser($username, $email, $password);
    if($result){
        echo "<script type='text/javascript'>
                alert('User Successfully registered!');
                window.location = '../forms/login.html';
            </script>";
    }else{
        echo "<script type='text/javascript'>
                alert('Something went wrong, try again!');
                window.location = '../forms/register.html';
            </script>";
    }



}

function registerUser($username, $email, $password){
    //save data into the file
    $csvFile = "../storage/users.csv";
    if (!file_exists($csvFile)) { //check if file exists, so can be read from
        touch($csvFile); //create if it does not exist
    }

    $csvHead = fopen($csvFile, "r");
    if(!($csvData = fgetcsv($csvHead))) { //check if header already exist in csv file
        fclose($csvHead);
        $csvHead = fopen($csvFile, 'w');
        fputcsv($csvHead,  ['Username','Email Address','Password']);
        fclose($csvHead); 
    }

    $csvData = fopen($csvFile, 'a'); //append new data to csv table
    if(fputcsv($csvData,  [$username, $email, $password])){ 
        fclose($csvData);
        return true;
    } else {
        fclose($csvData);
        return false;
    }
   
}
// echo "HANDLE THIS PAGE";



