<!DOCTYPE html>

<html lang="en">
    <body>
    Update Employee by ID
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"];)?>" class="border">
        ID <br><input type="text" name="id" value="<?php echo $id;?>"> <br>
        Full Name <br> <input type="text" name="fullanme" value="<?php echo $fullname;?>"> <br>
        Age <br> <input type="text" name="age" value=" <?php echo $age ?>"> <br>
        Address <br> <input type="text" name="address" value ="<?php echo $address?>"> <br>
        Salary <br> <input type="text" name="salary" value ="<?php echo $salary?>"> <br>
        <input type="submit" name="submit" value="submit">
    </form>

    <?php
    $id = $_POST["id"];
    $fullname = $_POST["fullname"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $salary = $_POST["salary"];
    function pg_connection_string_from_database_url(){
        extract(parse_url($_ENV["DATABASE_URL"]));
        return "user=$user password=$password host=$host dbname=" .substr($path, 1);
    }
    $db = pg_connect(pg_connection_string_from_database_url());
    if(!$db){
        echo "Error: Unable to open database\n";
    }else{
        echo "Open database successfully\n";
    }
    $sql = "UPDATE COMPANY SET NAME='$fullname', AGE='$age', ADDRESS='$address', SALARY='$salary' WHERE ID='$id'";
        print "<br>$sql<br>";
        $ret = pg_query($db, $sql);
        $cmdtuples = pg_affected_rows($ret);
        if(!$ret){
            echo preg_last_error($db);
        }
        echo "$cmdtuples employee is Deleted!";
        pg_close($db);
    ?>
    </body>

</html>

