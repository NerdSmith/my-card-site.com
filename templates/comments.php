<div class="BlockInfo"> 
    <div class="Content">
        <table>
        <?php 
            require_once 'connection.php';
            $con = mysqli_connect($host, $user, $password);
            $db_selected = mysqli_select_db($con, $database);
            mysqli_query($con, 'USE ' . $database);
            
            $query = "SELECT * FROM visitors"; 
            $result = mysqli_query($con, $query);

            echo "<tr><th> Nick </th><th> Date </th><th> Comment </th></tr>";
            while($row = mysqli_fetch_array($result)){   
            echo "<tr><td>" . $row['nick'] . "</td><td>" . $row['date'] . "</td><td>" . $row['text'] ."</td></tr>";  //$row['index'] the index here is a field name
            }
            
            mysqli_close($con); 
        
        ?>
        </table>
        
    </div>
</div>