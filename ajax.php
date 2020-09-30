<?php

//Including Database configuration file.

include "config/config.php";


//Getting value of "search" variable from "script.js".

if (isset($_POST['search'])) {

//Search box value assigning to $Name variable.

   $Name = $_POST['search'];
   $followsid = $_POST['followid'];
   
//Search query.

   $Query = "SELECT `Username`,`Id` FROM users WHERE `Username` LIKE '$Name%' LIMIT 5";

//Query execution

   $ExecQuery = MySQLi_query($con, $Query);

//Creating unordered list to display result.

   echo '

<ul>

   ';

   //Fetching result from database.

   while ($Result = MySQLi_fetch_array($ExecQuery)) {

       ?>

   <!-- Creating unordered list items.

        Calling javascript function named as "fill" found in "script.js" file.

        By passing fetched result as parameter. -->

   <li onclick='fill("<?php echo $Result['Name']; ?>")'>

   <a href="user.php?id=<?php echo $followsid;?>">

   <!-- Assigning searched result in "Search box" in "search.php" file. -->

       <?php 
       echo $Result['Username']; 
       $_SESSION['uid'] = $Result['Id'];
       ?>

   </li></a>

   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php

}}


?>

</ul>