 <?php  

$testcases = array();
// $testcases[] = array(
//     'fullpage' => ""
//     'user_id' =>  "",
//     'searchquery' => "",
//     'testname' => "",
//     'expectedstate' => ""
// );

//MrTesters id=23

//not a possible test
/*$testcases[] = array(
    'fullpage' => "true",
    'searchquery' => "",
    'testname' => "User Not logged in",
    'expectedstate' => "Redirect to log in, succesful log in will redirect back to search page"
);
*/
$testcases[] = array(
    'fullpage' =>"true",
    'user_id' =>  "23",
    'searchquery' => "itemname=la&onlyborrowable=True&grouplist%5B%5D=2",
    'testname' => "Search queries filled in form",
    'expectedstate' => "search is la    onlyborrowable is checked   garden tools group is selected"
);

$testcases[] = array(
    'fullpage' =>"true",
    'user_id' =>  "23",
    'searchquery' => "itemname=wheel",
    'testname' => "Search queries filled in form 2",
    'expectedstate' => "search is wheel"
);

$testcases[] = array(
    'user_id' =>  "23",
    'searchquery' => "itemname=la",
    'testname' => "search term only",
    'expectedstate' => "Ladder Lathe and Laser displayed"
);

$testcases[] = array(
    'user_id' =>  "23",
    'searchquery' => "itemname=la&onlyborrowable=True",
    'testname' => "Show Borrowable Only",
    'expectedstate' => "Lathe and Laser displayed, borrowed by collumn not shown, all shown items are borrowable"
);

$testcases[] = array(
    'user_id' =>  "23",
    'searchquery' => "itemname=la",
    'testname' => "Users offered items not displayed (MrTester logged in)",
    'expectedstate' => "Lathe, Laser, Ladder"
);

$testcases[] = array(
    'user_id' =>  "9",
    'searchquery' => "itemname=la",
    'testname' => "Users offered items not displayed (Brandon logged in)",
    'expectedstate' => "Lamp, Lasso, Ladder"
);

$testcases[] = array(
    'user_id' =>  "4",
    'searchquery' => "itemname=la",
    'testname' => "Users offered items not displayed (Brandon and MrTester not loggedin)",
    'expectedstate' => "Brandon and MrTesters items shown"
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
      echo "<iframe class=\"searchtestframe\" src=\"testsearchframe.php?";
      foreach ($case as $key => $value) {
          if ($key == 'searchquery') echo $value . "&";
          else echo "$key=$value&";
      }
      echo "\"> </iframe>";
  }

  ?>

  </body>
  </html>

