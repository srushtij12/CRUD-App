<?php 
           $insert=false;
           $update=false;
           $delete=false;
        // INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'Holidat2', 'Its Holiday', current_timestamp());
           $servername = "localhost";
           $username = "root";
           $password = "";
           $database = "notes";
           $con = mysqli_connect($servername,$username,$password,$database);
           if(!$con)
           {
             die("sorry , failed to connect ". mysqli_connect_error());
           }
          

           if(isset($_GET['delete'])){
            $sn = $_GET['delete'];
            $sql = "DELETE FROM `notes` WHERE `notes`.`sno` = $sn";
            $result = mysqli_query($con,$sql);

            if($result){
         
              $delete=true;
             }
             else{
              echo "No";
             }
           }

           if($_SERVER['REQUEST_METHOD'] == 'POST')
           {
           // $title = $_POST["title"];
            //$description = $_POST["description"];
            if(isset($_POST['snoedit']))
            {
              $description = $_POST['description_edit'] ?? '';
              $title = $_POST['title_edit'] ?? '';
              $sno1 = $_POST['snoedit'] ?? '';
        
         $sql1 = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `sno` = $sno1 ";
         $result = mysqli_query($con,$sql1);
         if($result){
          
          $update=true;
         }
         else{
          echo "No";
         }
            }
            else{
            $description = $_POST['description'] ?? '';
            $title = $_POST['title'] ?? '';
       
      
       $sql1 = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
       $result = mysqli_query($con,$sql1);
        
       if($result)
       {
      $insert = true;
        
       }
      
       else{
        echo  "<Your Entry has not submitted!!!";
           }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
   
   
    <title>MyNotes</title>
    
  </head>
  <body>


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Edit modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit This Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/index.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="snoedit" id="snoedit">
            <div class="mb-3">
              <label for="title_edit" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="title_edit" name="title_edit" aria-describedby="emailHelp">
              
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="description_edit" name ="description_edit" style="height: 100px"></textarea>
                <label for="description_edit">Notes Description</label>
              </div>
           <div class="container mt-4 ">
            <button type="submit" class="btn btn-primary">Update Note</button>
        </div>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>...
    </div>
  </div>
</div>



    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">MyNotes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
              </li>
              
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
             
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

<?php 
   if($insert)
   {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your note has been submitted!!!</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
   }
   if($update)
   {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your note has been updated submitted!!!</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
   }
   if($delete)
   {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your note has been deleted submitted!!!</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
   }
?>



      <div class="container mt-5">
        <h2>Add Your Note Here!!</h2>
        <form action="/index.php" method="POST">
            <div class="mb-3">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
              
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="desc" name ="description" style="height: 100px"></textarea>
                <label for="description">Notes Description</label>
              </div>
           <div class="container mt-4 ">
            <button type="submit" class="btn btn-primary">Add Note</button>
        </div>
          </form>
      </div>

      <div class="container mt-3 my-4">
    


<table class="table" id = "myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php 
           $sql = "select * from notes";
           $result = mysqli_query($con,$sql);
           $no=0;
           while($row = mysqli_fetch_assoc($result))
           {
            $no = $no+1;
            echo " <tr>
            <th scope='row'>" . $no . "</th>
            <td>" . $row['title'] . "</td>
            <td>" . $row['description'] . "</td>
            <td><button class='edit btn btn-sm btn-primary' id=" .$row['sno'] ."> Edit </button>  <button class='delete btn btn-sm btn-primary' id=d" .$row['sno'] ."> Delete </button> </td>
          </tr>";
           
           }
        ?>
   

  </tbody>
</table>

      </div>
      <hr>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script
  src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
   <script>
    let table = new DataTable('#myTable');
  
   </script>
   <script>
     edits =  document.getElementsByClassName('edit');
     Array.from(edits).forEach((element) => {
      element.addEventListener("click",(e)=>{
        console.log("edit",);
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        title_edit.value = title;
        description_edit.value = description;
        snoedit.value = e.target.id;
        $('#exampleModal').modal('toggle');
      })
     })
</script>
<script>
     deletes =  document.getElementsByClassName('delete');
     Array.from(deletes).forEach((element) => {
      element.addEventListener("click",(e)=>{
      
        sno = e.target.id.substr(1,);
        window.location = `/index.php?delete=${sno}`;
        if(confirm("Do you really want to delete this note ??"))
        {
                   
        }
      })
     })
    </script>
  </body>
</html>