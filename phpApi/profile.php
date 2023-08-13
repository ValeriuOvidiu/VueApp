<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type"); 
header("Content-Type: application/json");


if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST)) {
    $_POST = json_decode(file_get_contents('php://input'), true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    require_once "databases.php";

    $sql = "SELECT firstName, lastName FROM user WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_row();
        $arr = array($row[0], $row[1]);
        echo json_encode($arr);
    } else {
        $arr = array();
        echo json_encode($arr);
    }

}

?>
