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
   
       
            $firstName= $_POST['firstName'];
           $lastName=$_POST['lastName'];
           $email=$_POST['email'];
            $password=$_POST['password'];
            $passwordHash=password_hash($password,PASSWORD_DEFAULT);
            require_once "databases.php";
            $checkEmail="SELECT * FROM user where email='$email'";
            $result=mysqli_query($conn, $checkEmail);
            $countRouws=mysqli_num_rows($result);
            if($countRouws==0){
            $sql="INSERT INTO user (firstName, lastName,email,password	)VALUES(?,?,?,?)";
            $stmt=mysqli_stmt_init($conn);
            $prepareStmt=mysqli_stmt_prepare($stmt,$sql);
            if($prepareStmt){ 
                mysqli_stmt_bind_param($stmt,"ssss",$firstName,$lastName,$email,$passwordHash);
                mysqli_stmt_execute($stmt);
                array_push( $arr, true );
             
               
                
            }else{
                array_push( $arr, false );   
                array_push( $arr, "Something whent wrong" );  
            }
        }else {
            array_push( $arr, false ); 
            array_push( $arr, "This email has been used before" );  
        }
          
            echo json_encode($arr);
} else {
   
    $arr = array(1, 2, 3, 4,  8,9);

echo json_encode($arr);  
}
?>    
