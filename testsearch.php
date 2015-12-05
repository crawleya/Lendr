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

/*$testcases[] = array(
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
*/


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
      echo "<iframe class=\"testframe\" src=\"testsearchframe.php?";
      foreach ($case as $key => $value) {
          if ($key == 'searchquery') echo $value . "&";
          else echo "$key=$value&";
      }
      echo "\"> </iframe>";
  }

  ?>

  </body>
  </html>

