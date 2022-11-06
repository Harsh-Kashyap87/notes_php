<?php

$insert = false;
  if($_SERVER['REQUEST_METHOD']=='POST')
  {
   $tittle = $_POST['tittle']; 
   $desc = $_POST['desc']; 

   $servername = "localhost";
   $username = "root";
   $password = "";
   $database = "notes";

   
   
   $conn = mysqli_connect($servername, $username, $password, $database);
   if(!$conn){
    die("ERROR! " .mysqli_error($conn));
   }
   else{
    // echo "POST";
    $sql = "INSERT INTO `note` (`tittle`, `desc`) VALUES ('$tittle','$desc')";
    $result = mysqli_query($conn, $sql);
    // echo "POST2";
    if($result){
      $insert = true;
    }
    else{
      echo "FAILES !!";
    }

   }


 }
 else {
  // echo "get";
 }
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>H-Notes</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">


</head>

<body>

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
          <li class="nav-item dropdown">

        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Alert -->

  <?php
  if($insert==true){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Successfully !</strong> your note has been insrted successfully...
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }


?>


  <!-- Form -->
  <h1 class="my-4">
    Add Your notes here.
  </h1>
  <div class="container">
    <form action="/project_1/index.php" method="post">
      <div class="mb-3">
        <label for="tittle" class="form-label">Notes's Tittle</label>
        <input type="text" name="tittle" class="form-control" id="tittle" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">Enter your Notes's Tittle.</div>
      </div>
      <div class="mb-3">
        <label for="desc" class="form-label">Description of your notes</label>
        <textarea class="form-control" name="desc" id="desc" rows="5"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Ad Notes</button>
    </form>
  </div>

  <!-- PHP -->
  <div class="container">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No.</th>
          <th scope="col">Tittle</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>


      <?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
  die("not connected ! " .mysqli_connect_error($conn));
}

$sql = "SELECT * FROM `note`";
$result = mysqli_query($conn, $sql);
// $num = mysqli_num_rows($result);
// echo $num ."<br>";
$sno = 0;
while($row = mysqli_fetch_assoc($result)){
  // echo var_dump($row);
  // echo $row['sno'].' ' . 'Hello, ' .$row['name'] .'Welcome to the ' .$row['dest'];
  $sno = $sno + 1;
  echo "
  <tbody>
  <tr>
    <th scope='row'>". $sno ."</th>
    <td>" .$row['tittle'] ."</td>
    <td>" .$row['desc'] ."</td>
    <td>
        <button type='button' class=' edit btn btn-outline-primary'>Edit</button><button type='button' class=' del btn btn-outline-primary'>Delete</button>
      </td>
  </tr>
</tbody>";
}



  ?>



    </table>
  </div>



  <!-- Bootsrap -->

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>

  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });

    <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/crud/index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>

</html>