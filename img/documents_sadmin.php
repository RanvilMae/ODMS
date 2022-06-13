<?PHP

session_start();

if (!isset($_SESSION['log'])) {
header('Location: index.php');
}

?>
<?php include 'logic_documents.php';?>
<!DOCTYPE html>
<html lang="en">
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TIEZA-MISD">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>TIEZA Portal</title>

    <link rel="icon" href="images/TIEZAlogo.png" type="image/gif" sizes="16x16">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/floating-labels/">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
     body, html {
      background-image: url("bg.png");
      height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
.jumbotron{
    background-image: url("bg.png");
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
       .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        font-size: 15px;
        background-color: #007acc;
        color: white;
        text-align: center;
        height: 4rem;
    }

    </style>
    <!-- Custom styles for this template -->
  
  </head>
  <body>

<?php include 'navigation_documents_sadmin.php';?>


<div class="container">
  <div class="jumbotron">
    <form action="documents_sadmin.php" method="post" enctype="multipart/form-data" >
    
         <h3><strong>UPLOAD DOCUMENTS</strong></h3>
          <hr>
          
     
    
          <label><strong>Date: </strong></label>
          <input class="form-control" name="date" disabled value="<?php date_default_timezone_set("Asia/Manila"); echo date("Y-m-d H:i:s");?>">
        
    <label><strong>File:</strong></label>
    <input type="file" class="form-control" id="exampleFormControlFile1" name="myfile" required><br>
    <button type="submit" name="save" class="btn btn-primary float-right"><i class="fas fa-upload"></i></button>
  </div>    
        </form>

<!-- Modal for download -->
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Download</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to upload file?
      </div>
      <div class="modal-footer">
      <button type="submit" name="save" class="btn btn-success"><i class="fas fa-upload"></i></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
  
      </div>
    </div>
  </div>
</div>
</div>


<main role="main" class="container">
  <div class="jumbotron"> 
  <div>
 <!----   <div class="float-right" style="padding-right: 10px;">
      <a href="forms_admin.php"><i class="fas fa-redo"></i></a>
    </div> --->
    <h3><strong>DOCUMENTS</strong></h3>
        
    <hr>
      </div>
 <div style="overflow-x:auto;">
    <table class="table table-dark">
    <tr align="center">
        <td><strong>FILENAME</strong></th>
    <td><strong>DATE</strong></th>
        <td><strong>ACTION</strong></th>
    </tr>
    <tbody>
    <?php
     $nquery=mysqli_query($conn,"select * from `documents` ORDER BY id DESC ");
    while($file = mysqli_fetch_array($nquery)){
  ?>
        <tr>
          <td><?php echo $file['name']; ?></td>
          <td><?php echo $file['date']; ?></td>
    
<td align="center">
  <div class="btn-group btn-group-justified">
  <button type="button" name="delete" title="DELETE" value="C:\xampp\htdocs\ss\documents<?php echo $file['name']?>" class="btn btn-primary">
    <a data-toggle="modal" data-target="#delete<?php echo $file['id']?>" style="text-decoration-none;color:white;">
      <i class="fas fa-trash-alt"></i>
    </a>
  </button>
      
  <button type="button" name="delete" name="fileToRemove" class="btn btn-primary" title="DOWNLOAD">
    <a data-toggle="modal" name="fileToRemove" data-target="#download<?php echo $file['id']?>" style="text-decoration-none;color:white;">
      <i class="fas fa-file-download"></i>
    </a>
  </button>
  </div>
     </tr>
     <!----MODAL FOR DELETE-->
     <div class="modal fade" id="delete<?php echo $file['id']?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>DELETE</strong></h5>
        </div>
        <div class="modal-body">
      Are you sure you want to delete <strong><?php echo $file['name'] ?></strong>?
      <div class="modal-footer">
         <a href="delete_documents.php?name=<?php echo $file['name'] ?>"   class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
             <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
          </div>
      </div>
    </div>
  </div>
</div>
     <!----MODAL FOR DOWNLOAD-->
      <div class="modal fade" id="download<?php echo $file['id']?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>DOWNLOAD</h5></strong>
        </div>
        <div class="modal-body">
      Are you sure you want to download <strong><?php echo $file['name'] ?>?</strong>
      <div style="clear:both;"></div>
      <div class="modal-footer">
         <a href="download_documents.php?file_id=<?php echo $file['id'] ?>"  class="btn btn-success"><i class="fas fa-file-download"></i></a>
             <button type="button" name="delete" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
          </div>
      </div>
    </div>
  </div>
</div> 
          <?php }?>


    </tbody>
    </table>
  </div>
  </main>
    
    <div class="row">
<footer class="footer">
    <div class="inner">
    <strong>Copyright &copy; 2019. All rights reserved.<br>Management Information Systems Department.</strong>
    <div class="float-right d-none d-sm-inline-block">
    </div>
    </div>
</footer>
</div>

    
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
      </body>
</html>