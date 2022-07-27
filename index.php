 <!-- Using HTML5 and Bootstrap 4 -->
 <!-- Made by Putu Surya Nugraha -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Simple CRUD</title>
  </head>
  <body>
  <?php require_once 'process.php'; ?>

  <?php
    if(isset($_SESSION['message'])):
  ?>
  <div class="alert alert-<?=$_SESSION['msg-type']?>">
      <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
      ?>
  </div>
  <?php endif?>
  <div class="container">
    <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name;?>" placeholder="Enter your name">
            </div>
            <div class="form-group">
            <label>University</label>
            <input type="text" name="univ" class="form-control" value="<?php echo $univ; ?>" placeholder="Enter your university">
            </div>
            <div class="form-group">
            <?php 
            if ($update == true):
            ?>
            <button type="submit" class="btn btn-info" name="update">Update</button>
            <?php else: ?>
            <button type="submit" class="btn btn-primary" name="save">Save</button>
            <?php endif; ?>
            </div>
        </form>
        </div>

    <!-- Fetching all database result to HTML page -->
    <?php 
      $mysqli = new mysqli('localhost','root','','univ') or die(mysqli_error($mysqli));
      $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
      ?>

      <div class="row justify-content-center">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>University</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>

      <?php
        while($row = $result->fetch_assoc()): ?>
          <tr>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['university']; ?></td>
              <td>
                <a href="index.php?edit=<?php echo $row['id'];?>"
                class="btn btn-info">Edit</a>
                <a href="process.php?delete=<?php echo $row['id'];?>"
                class="btn btn-danger">Delete</a>
              </td>
          </tr>

        <?php endwhile; ?>
        </table>
  <!-- function just for testing the fetch result -->         
    <?php
      function pre_r ($array){
        echo'<pre>';
        print_r($array);
        echo'<pre>';
      }
    ?>


    <!-- Disclaimer!, im not using any kind of JS in this system -->
    <!-- This just an optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
  </div>
  
  </body>
</html>







