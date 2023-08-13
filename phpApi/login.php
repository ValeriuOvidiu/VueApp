<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type"); 
header("Content-Type: application/json");
if($_SERVER["REQUEST_METHOD"]=="POST" && empty($_POST))
{
    $_POST = json_decode(file_get_contents('php://input'),true);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $email=$_POST['email'];
            $password=$_POST['password'];
            require_once "databases.php";
            $checkEmail="SELECT * FROM user where email='$email'";
            $result=mysqli_query($conn, $checkEmail);
            $user=mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($user){
          if( password_verify($password,$user["password"])){
            array_push( $arr, true );
          }else{
            array_push( $arr, false ); 
            array_push( $arr, "This password is invalid" );  
          }
            
        }else {
            array_push( $arr, false ); 
            array_push( $arr, "This email is invalid" );  
        }
          
            echo json_encode($arr);
} else {
   
    $arr = array(1, 2, 3, 4,  8,7);

echo json_encode($arr);  
}
?>    
