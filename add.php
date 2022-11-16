<!DOCTYPE html>
<html lang="en">
<body>
Insert Employee
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="border">
          ID<BR> <input type="text" name="id" value ="<?php echo $id;?>"><BR>
          Full Name<BR> <input type="text" name="fullname" value ="<?php echo $fullname;?>"><BR>
	  Age<BR> <input type="text" name="age" value ="<?php echo $age ?>"><BR>
          Address<BR> <input type="text" name="address" value ="<?php echo $address ?>"><BR>
          Salary<BR> <input type="text" name="salary" value ="<?php echo $salary ?>"><BR>
          <input type="submit" name="submit" value="submit">

	</form>
 <?php
            $id=$_POST["id"];
            $fullname=$_POST["fullname"];
            $age=$_POST["age"];
	    $address=$_POST["address"];
    	    $salary=$_POST["salary"];
            function pg_connection_string_from_database_url() {
                extract(parse_url($_ENV["DATABASE_URL"]));
                return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
              }
		$db = pg_connect(pg_connection_string_from_database_url() );
                 if(!$db){
                    echo "Error : Unable to open database\n";
                 } else {
                    echo "Open database successfully\n";
                 }
		 $sql = "INSERT INTO COMPANY (ID, NAME, AGE, ADDRESS, SALARY) VALUES ('$id','$fullname','$age', '$address', '$salary')";
                 print "<BR>$sql<BR>";
                 $ret = pg_query($db, $sql);
                 if(!$ret){
                    echo pg_last_error($db);
                 } else {
                    echo "Insert successfully\n";
                 }
                 pg_close($db);

?>

</body>
</html>