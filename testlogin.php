 <?php  

$testcases = array();
/*$testcases[n] = array(
    'request' => "",
    'username' => "",
    'password' => "",
    'testname' => "",
    'expectedstate' => "",
    'expectedid' => ""
);*/
$testcases[] = array(
    'request' =>  "login",
    'username' => "MrTester",
    'password' =>  "Garbage",
    'testname' =>  "Bad Password",
    'expectedstate' =>  "log in refused",
    'expectedid' =>  "Not Set",
);
$testcases[] = array(
    'request' =>  "login",
    'username' => "MrTester",
    'testname' =>  "Password not supplied",
    'expectedstate' =>  "log in refused",
    'expectedid' =>  "Not Set"
);
$testcases[] = array(
    'request' =>  "login",
    'username' =>  "nondefineduser",
    'password' =>  "password",
    'testname' =>  "Log in with username not in database",
    'expectedstate' =>  "log in refused",
    'expectedid' =>  "Not Set"
);
$testcases[] = array(
    'request' =>  "signup",
    'username' =>  "MrTester",
    'password' =>  "doesntmatter",
    'testname' =>  "User Name Already Taken",
    'expectedstate' =>  "Sign up refused",
    'expectedid' =>  "Not Set"
);
$testcases[] = array(
    'request' =>  "signup",
    'username' =>  "newuser",
    'password' =>  "",
    'testname' =>  "Blank password provided",
    'expectedstate' =>  "Sign up refused",
    'expectedid' =>  "Not Set"
);
$testcases[] = array(
    'username' =>  "newuser",
    'password' =>  "newpassword",
    'testname' =>  "No Request given",
    'expectedstate' =>  "Normal login page displayed",
    'expectedid' =>  "Not Set"
);
$testcases[] = array(
    'request' =>  "Garbage",
    'username' =>  "newuser",
    'password' =>  "newpassword",
    'testname' =>  "Non specified Request given",
    'expectedstate' =>  "We cannot perform that action right now",
    'expectedid' =>  "Not Set"
);
$testcases[] = array(
    'request' =>  "login",
    'username' =>  "MrTester",
    'password' =>  "password",
    'testname' =>  "Succsessfull login",
    'expectedstate' =>  "User is Logged in Succsessfully",
    'expectedid' =>  "23"
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

