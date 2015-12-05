 <?php  

$testcases = array();
/*$testcases[n] = array(
    'request' => , ""
    'username' => , ""
    'password' => , ""
    'testname' => , ""
    'expectedstate' => , ""
    'expectedid' => , ""
);*/
$testcases[0] = array(
    'request' =>  "login",
    'username' => "Brandon",
    'password' =>  "Garbage",
    'testname' =>  "Bad Password",
    'expectedstate' =>  "log in refused",
    'expectedid' =>  "Not Set",
);
$testcases[1] = array(
    'request' =>  "login",
    'username' => "Brandon",
    'testname' =>  "Password not supplied",
    'expectedstate' =>  "log in refused",
    'expectedid' =>  "Not Set",
);
$testcases[2] = array(
    'request' =>  "signup",
    'username' =>  "Brandon",
    'password' =>  "doesntmatter",
    'testname' =>  "User Name Already Taken",
    'expectedstate' =>  "Sign up refused",
    'expectedid' =>  "Not Set",
);
$testcases[3] = array(
    'request' =>  "signup",
    'username' =>  "newuser",
    'password' =>  "",
    'testname' =>  "Blank password provided",
    'expectedstate' =>  "Sign up refused",
    'expectedid' =>  "Not Set",
);
$testcases[4] = array(
    'request' =>  "login",
    'username' =>  "Brandon",
    'password' =>  "password",
    'testname' =>  "Succsessfull login",
    'expectedstate' =>  "User is Logged in Succsessfully",
    'expectedid' =>  "9",
);

 ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/unittest.css" />
</head>
<body>

  <?php 

  #echo "<br><iframe src=\"testloginframe.php?request=login&username=Bob&password=Bob\"></iframe>";

  foreach ($testcases as $case) {
      echo "<iframe class=\"testframe\" src=\"testloginframe.php?";
      foreach ($case as $key => $value) {
          echo "$key=$value&";
      }
      echo "\"> </iframe>";
  }

  ?>

  </body>
  </html>

