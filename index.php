<?php
    
    //connecting to a server/database

    $servername ="localhost";
    $username="root";
    $password="";
    $database="notes";

    $conn = mysqli_connect($servername,$username,$password,$database);

    if ($_SERVER['REQUEST_METHOD']=='POST')
    {
        $title=$_POST['title'];
        $description=$_POST['description'];
      
      $sql="INSERT INTO `notes` (`title`, `description`) VALUES ( '$title', '$description')";
                  
      if(mysqli_query($conn,$sql)){}
      else
      {
          echo "<br>";
          echo "submission unsucessful  ".mysqli_error($conn);
      }
  }
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


  <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

  <title>e-Notes</title>
</head>

<body>

      <!-- Edit modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editmodal">
        Edit modal
      </button>

      <!--Edit Modal -->
      <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editmodalLabel">Modal title</h5>
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



  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">e-Notes</a>
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
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>


        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <div class="container my-4">
    <h2>Add a note</h2>
    <form action="/CRUD/index.php" method="post">
      <div class="form-group">
        <label for="title">NOTE title</label>
        <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title">

      </div>

      <div class="form-group">
        <label for="description">NOTE description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary my-2">ADD Note</button>
    </form>
  </div>

  <div class="container my-4">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">sno</th>
          <th scope="col">title</th>
          <th scope="col">description</th>
          <th scope="col">timestamp</th>
          <th scope="col">action</th>

        </tr>
      </thead>
      <tbody>

        <?php
      $sql="SELECT * FROM `notes`";
      $result =mysqli_query($conn,$sql);
      $sno=1;
      while($row=mysqli_fetch_assoc($result))
      {
            
        echo "<tr>
        <th scope='row'>".$sno++."</th>
        <td>".$row['title']."</td>
        <td>".$row['description']."</td>
        
        <td>".$row['timestamp']."</td>
        <td> <a href='/edit'>EDIT</a>   <a href='/del'>DELETE</a></td>
      </tr>";        
      }

?>
</tbody>
    </table>

  </div>
  <hr>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
    crossorigin="anonymous"></script>

  <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>


  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>

</body>

</html>