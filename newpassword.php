<?php
$password = rand(999, 99999);
$password_hash = md5($pass);

$r = mysqli_fetch_assoc($res);
      $username = $r['username'];

      $usql = "UPDATE `login` SET password='$password_hash' WHERE username='$username'";
      $result = mysqli_query($connection, $usql);
      if($result){
      //send email here
      }

     
