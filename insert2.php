<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        
    $tittle = $_POST['tittle'];
    $desc = $_POST['desc'];

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "notes";

  $conn = mysqli_connect($servername, $username, $password, $database);

  if(!$conn){
    die("not connected ! " .mysqli_connect_error($conn));
  }
  else{
    echo "GO! <br>";
  }

  $sql = "INSERT INTO `note` (`tittle`, `desc`) VALUES ('$tittle','$desc')";

  $result = mysqli_query($conn, $sql);
  if($result){
    echo $tittle." and " .$desc;
  }
  else{
    echo "NO!! <br>" .mysqli_error($conn);
  }

  
    }
    else{
        echo "NO!";
    }

?>