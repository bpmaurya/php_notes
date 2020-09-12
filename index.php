<?php
// INSERT INTO `notes` (`sno`, `title`, `desc`, `tstamp`) VALUES (NULL, 'first notes', 'hello this is fist notes about php programmer', current_timestamp());

$insert = false;
$update = false;
$delete = false;

//connect to the database


$servername = "localhost";
$username = "root";
$password = "";
$database = "phpnotes";


$conn = mysqli_connect($servername,$username,$password,$database);
//die if connection was not successful
if(!$conn){
    die("sorry we failed to connect :". mysqli_connect_error());
}


if(isset($_GET['delete'])){
  
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `notes`.`sno` = $sno";
  $result = mysqli_query($conn,$sql);

}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['snoEdit'])){
    //update the record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];

//sql query to be executed
$sql = "UPDATE `notes` SET `title` = '$title' , `desc` = '$description' WHERE `notes`.`sno` = $sno";
$result = mysqli_query($conn,$sql);
if($result){
  $update = true;
}
  }
  else{
$title = $_POST["title"];
$description = $_POST["description"];

//sql query to be executed
$sql = "INSERT INTO `notes` (`sno`, `title`, `desc`, `tstamp`) VALUES (NULL, '$title', '$description', current_timestamp())";

$result = mysqli_query($conn,$sql);
//check for the database creation success
if ($result){
    // echo "<br> the record  was created successfully";
     $insert = true;
  }
else{
    echo "The record was not created".mysqli_error($conn)."<br>";
}
}
}
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
    
    
   

    <title>NOtes Book!</title>
    
  </head>
  <body>
    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  Edit
</button> -->

<!--edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/crud_project/index.php" method="post">
          <input type="hidden" name="snoEdit" id="snoEdit">
          <div class="form-group">
            <label for="title">Edit Notes</label>
            <input
              type="text"
              class="form-control"
              id="titleEdit"
              name ="titleEdit"
              aria-describedby="emailHelp"
            />
          </div>
  
          <div class="form-group">
            <label for="desc">Note Descriptions</label>
            <textarea class="form-control" id="descriptionEdit" name ="descriptionEdit" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Update Note</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#"><img src="logo.png" height="25px"></a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"
              >Home <span class="sr-only">(current)</span></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a
              class="nav-link disabled"
              href="#"
              tabindex="-1"
              aria-disabled="true"
              >Disabled</a
            >
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input
            class="form-control mr-sm-2"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Search
          </button>
        </form>
      </div>
    </nav>
      <?php
      if($insert){
        echo "<div class= 'alert alert-success alert-dismissible fade show' role='alert'>
        <strong>You successfully submit!</strong> your data submit success congrats!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
        }
   ?>
      <?php
      if($delete){
        echo "<div class= 'alert alert-success alert-dismissible fade show' role='alert'>
        <strong>You successfully deleted!</strong> your data submit success congrats!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
        }
   ?>
      <?php
      if($update){
        echo "<div class= 'alert alert-success alert-dismissible fade show' role='alert'>
        <strong>You successfully Updated!</strong> your data submit success congrats!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
        }
   ?>

    <div class="container my-4">
      <h2>Add a Notes</h2>
      <form action="/crud_project/index.php?update=true" method="post">
        <div class="form-group">
          <label for="title">Notes Title</label>
          <input
            type="text"
            class="form-control"
            id="title"
            name ="title"
            aria-describedby="emailHelp"
          />
        </div>

        <div class="form-group">
          <label for="description">Note Descriptions</label>
          <textarea class="form-control" id="description" name ="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
      </form>
    </div>

    <div class="container ">
     
      <table class="table my-4" id ="myTable">
        <thead>
          <tr>
            <th scope="col">S.No</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
          
        </thead>
        <tbody>

        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn,$sql);
        $sno = 1;
        while($row = mysqli_fetch_assoc($result)){
         
          echo "<tr>
          <th scope='row'>". $sno . "</th>
          <td>". $row['title']. "</td>
          <td>". $row['desc']. "</td>
          <td><button class='btn delete btn-sm btn-primary' id=d". $row['sno']. ">Delete</button></button>
            <button class='btn edit btn-sm btn-primary' id=". $row['sno']. ">Edit</button></td>
        </tr>";
          $sno++;
        }
        ?>
        </tbody>
      </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
      integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
      integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
      crossorigin="anonymous"
    ></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">


  <script>

    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
  </script>
  
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach(element => {
      element.addEventListener("click",(e)=>{
        console.log("edit", );
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title,description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle') 
      })
      
    });

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach(element => {
      element.addEventListener("click",(e)=>{
        console.log("delete", );
        sno = e.target.id.substr(1,);

        if(confirm("Are You Sure You want to delete??")){
          console.log("yes")
          window.location = `/crud_project/index.php?delete=${sno}`;
        //TODO: Create a form and use post request to submit a form 
        
        }
        else{
          console.log("No")
        }
      })
      
    });

</script>
  </body>
</html>
