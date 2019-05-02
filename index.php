<html>
<head>
    <title>Registration Form</title>
     <style type="text/css">
        body { background-color: #fff; border-top: solid 10px #000;
     	    color: #333; font-size: .85em; margin: 20; padding: 20;
     	    font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
     	}
     </style>
 </head>
 <body>
 <h1>Register here!</h1>
 <form method="post" action="index.php" enctype="multipart/form-data" >
     <table>
        <tr>
            <td>Name</td>
            <td>: <input type="text" name="name">
        </tr>
         <tr>
            <td>Date of Birth</td>
            <td>: <input type="date" name="date_of_birth">
        </tr>
         <tr>
            <td>Address</td>
            <td>: <textarea name="address"> </textarea>
        </tr>
         <tr>
            <td>Phone Number</td>
            <td>: <input type="text" name="phone_number">
        </tr>
         <tr>
            <td>E-mail</td>
            <td>: <input type="email" name="email">
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Simpan">
            <td><input type="submit" name="load_data" value="Load Data" />
        </tr>
    </table>
 </form>

 <?php
    $host = "sub1server.database.windows.net";
    $username = "dhilasadrah";
    $pass = "osh35an94!";
    $db = "sub1database";
    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $username, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }

  //  $serverName = "sub1server.database.windows.net"; //serverName\instanceName
   // $connectionInfo = array( "Database"=>"sub1database", "UID"=>"dhilasadrah", "PWD"=>"osh35an94!");
   // $conn = sqlsrv_connect( $serverName, $connectionInfo);
    
    if (isset($_POST['submit'])) {
        try {
            $name = $_POST['name'];
            $date_of_birth = $_POST['date_of_birth'];
            $address = $_POST['address'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];
            $join_date = date("Y-m-d");
            
            $sql_insert = "INSERT INTO registration (name, date_of_birth, address, phone_number, email, join_date) 
                        VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $name);
            $stmt->bindValue(2, $date_of_birth);
            $stmt->bindValue(3, $address);
            $stmt->bindValue(4, $phone_number);
            $stmt->bindValue(5, $email);
            $stmt->bindValue(6, $join_date);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
        echo "<h3>Your're registered!</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM registration";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
                echo "<h2>People who are registered:</h2>";
                echo "<table border='1' width='80%'>";
                echo "<tr><th>Name</th>";
                echo "<th>Date of Birth</th>";
                echo "<th>Address</th>";
                echo "<th>Phone Number</th>";
                echo "<th>E-mail</th>";
                echo "<th>Join Date</th></tr>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['name']."</td>";
                    echo "<td>".$registrant['date_of_birth']."</td>";
                    echo "<td>".$registrant['address']."</td>";
                    echo "<td>".$registrant['phone_number']."</td>";
                    echo "<td>".$registrant['email']."</td>";
                    echo "<td>".$registrant['join_date']."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<h3>No one is currently registered.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
 </body>
 </html>