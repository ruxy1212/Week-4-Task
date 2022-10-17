<?php
logout();
header('location: ../index.php');

function logout(){
   if(session_status() != PHP_SESSION_NONE){
       session_unset();
   }
   session_destroy();
}

// echo "HANDLE THIS PAGE";
