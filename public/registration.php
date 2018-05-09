<!DOCTYPE html>
<html>

<body>

      <h1>Registration Form</h1>
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <input type="text" name="username" value="" placeholder="Username">
        <input type="password" name="password" value="" placeholder="Password">
        <button type="submit" name="submit">Submit</buttom>
      </form>


    <?php 
    require_once("../config/config.php");
    if(isset($_POST['submit'])){
        
        $username  = $_POST['username'];
        $password = $_POST['password'];
        
        $options = array("cost"=>8);
        $hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
        $sql = "INSERT INTO credentials (username, password) VALUES ('".$username."', '".$hashPassword."')";
        $result = $pdo->prepare($sql);
        $result->execute();
        if($result)
        {
          echo "<h1>Registration successfully</h1>";
        }
      }

    ?>

</body>
</html>