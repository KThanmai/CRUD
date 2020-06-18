<?php
session_start();
$mysqli = new mysqli('localhost','root','Thanmai@4','crud') or die(mysqli_error($mysqli));
$id=0;
$update=false;
$name='';
$email='';
$phone='';
$branch='';
if (isset($_POST['save'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$branch = $_POST['branch'];

	$mysqli->query("INSERT INTO data(name, email, phone, branch) VALUES('$name', '$email', '$phone', '$branch')") or 
			die($mysqli->error);
	$_SESSION['message']="Record has been saved!";
	$_SESSION['msg_type']="success";
	header("location: index.php");
}
if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());
	$_SESSION['message']="Record has been deleted!";
	$_SESSION['msg_type']="danger";
	header("location: index.php");
}
if (isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update=true;
	$result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
	if(count($result)==1){
		$row = $result->fetch_array();
		$name=$row['name'];
		$email=$row['email'];
		$phone=$row['phone'];
		$branch=$row['branch'];
	}
}
if (isset($_POST['update'])){
	$id=$_POST['id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$branch=$_POST['branch'];
	$mysqli->query("UPDATE data SET name='$name',email='$email',phone='$phone',branch='$branch' WHERE id=$id") or die($mysqli->error);
	//header("location: index.php");
}
