<?php
$hostName="localhost";
$dbUser="root";
$dbPassword="";
$dbNmae="authenticatedb";
$conn=mysqli_connect($hostName,$dbUser,$dbPassword,$dbNmae);
$arr = array( );  
if(! $conn )  
{  
  array_push($arr,'Could not connect: ' );
 
}else{
  array_push($arr, 'Connected successfullyn' );
   
}  
 

?>  

