<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login Form</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='./css/login.css'>

</head>

<body>
    <?php      
       session_start();
      include('connection.php');  
      if(isset($_POST["login"])!=null){
      $username = $_POST['user'];  
      $password = $_POST['pass'];  
          //to prevent from mysqli injection  
          $username = stripcslashes($username);  
          $password = stripcslashes($password);  
          $username = mysqli_real_escape_string($conn, $username);  
          $password = mysqli_real_escape_string($conn, $password);  

          $sql = "select *from users where nom = '$username' and password = '$password'";  
          $result = $conn->query($sql);
      
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $_SESSION['name'] =$row["name"];
              $_SESSION['emailUser'] =$row["email"];
              $_SESSION['password'] =$row["password"];
              $_SESSION['type']   = $row["type"];
              if ($row["type"]=='0') {
                  header("Location: http://localhost/lab/patient.php");
              }else if($row["type"]=='1'){
                  header("Location: http://localhost/lab/laboratory.php");
              }
            }
          } else {
            echo "check your username or password";
          }
          $conn->close();
        }
  ?>
    <div class="center">
        <h1>Login</h1>
        <form method="post">
            <div class="txt_field">
                <input type="text" required name="user">
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="password" required name="pass">
                <span></span>
                <label>Password</label>
            </div>
            <input type="submit" value="Login" name="login">
            <div class="signup_link">
                Not a member ?
                <a href="http://localhost/lab/singup.php">Signup</a>
            </div>
        </form>
    </div>
</body>

</html>