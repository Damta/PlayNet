<?php
session_start();

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "pn";

try
{
     $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}
  $uname = trim($_POST['name']);
  $uuser = trim($_POST['username']);
  $umail = trim($_POST['email']);
  $upass = trim($_POST['password']);
  $ucheckpass = trim($_POST['confirm']);
  if($uuser=="") {
     $error = "provide username !";
     echo $error;
  }
  else if($umail=="") {
     $error = "provide email id !";
     echo $error;
  }
  else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
     $error = "Please enter a valid email address !"  ;
     echo $error;
  }
  else if($upass=="") {
     $error = "provide password !";
     echo $error;
  }
  else if(strlen($upass) < 6){
     $error = "Password must be atleast 6 characters";
     echo $error;
  }
  else if($upass != $ucheckpass){
    $error = "Passwords dont match!";
    echo $error;
  }
  else
  {
     try
     {
        $stmt = $DB_con->prepare("SELECT * FROM users WHERE username=:uname OR email=:umail");
        $stmt->execute(array(':uname'=>$uuser, ':umail'=>$umail));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        if($row['user_name']==$uname) {
           $error = "sorry username already taken !";
        }
        else if($row['user_email']==$umail) {
           $error = "sorry email id already taken !";
        }
        else
        {
            $createuser = $DB_con->prepare("INSERT INTO `users` (`name`, `email`, `username`, `password`) VALUES ('$uname', '$umail', '$uuser', '$upass')");
            $createuser->execute();
            echo "ddfds";

        }
    }
    catch(PDOException $e)
    {
       echo $e->getMessage();
    }
 }
?>
