<!DOCTYPE html>

<html lang="en">
    <body>
        List
        <?php
            function pg_connection_string_from_database_url(){
                extract (parse_url($_ENV["DATABASE_URL"]));
                return "user=$user password=$pass host=$host dbname=" .substr($path, 1);
            }
            $db = pg_connect(pg_connection_string_from_database_url());
            if(!db){
                echo "Error: Unable to open Database\n";
            }else{
                echo "Open database successfully\n";
            }
            $sql = "SELECT * FROM COMPANY";
            print "<br> $sql <br>";
            $ret = pg_query($db, $sql);
            if(!$ret){
                echo pg_last_error($db);
            }else{
                echo "List successfully\n";
            }
            pg_close($db);
        ?>
        <table boder="1" cellspacing="2" cellpadding="2">
            <tr><td>ID</td><td>Full Name</td><td>Age</td><td>Adress</td><td>Salary</td></tr>
            <?php
            while($myrow=pg_fetch_assoc($ret)){
                printf("<tr><td>%d</td><td>%s</td><td>%d</td><td>%s</td><td>%f</td></tr>", $myrow['id'], $myrow['name'],$myrow['age'],$myrow['address'],$myrow['salary']);
            }
            pg_close($db);
            ?>
        </table>
    </body>
</html>