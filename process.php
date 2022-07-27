<?php
//session start
session_start();
//connect to database, using MySQL XAMPP
$mysqli = new mysqli('localhost','root','','univ') or die(mysqli_error($mysqli));
//set the initial value of the variable
$id = 0;
$update = false;
$name ='';
$univ ='';

//if save button is presssed
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $univ = $_POST['univ'];

    //add a session message
    $_SESSION['message'] = "Data added to database!";
    $_SESSION['msg-type'] = "success";

    $mysqli->query("INSERT INTO data (name, university) VALUES('$name', '$univ') ") or 
    die($mysqli->error);

    //go back to index.php
    header("location: index.php");


}

//if delete button is pressed
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Data deleted from database!";
    $_SESSION['msg-type'] = "danger";

    header("location: index.php");
}


//if edit button is pressed
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if(count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $univ = $row['university'];
    }
}

//if update button is pressed
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $univ = $_POST['univ'];

    $mysqli->query("UPDATE data SET name='$name', university='$univ' WHERE id=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "Data updated to database!";
    $_SESSION['msg-type'] = "warning";

    header("location: index.php");
}