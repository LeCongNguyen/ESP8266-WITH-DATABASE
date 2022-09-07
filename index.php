<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="refresh" content="30">
    <style>
        td {
            padding: 0 20px;
        }
    </style>
</head>

<body>
    <div style="display:flex; justify-content:center; align-items:center; text-align:center">
        <?php

        $servername = "localhost";

        // REPLACE with your Database name
        $dbname = "id19516608_ds18b20_data";
        // REPLACE with Database user
        $username = "id19516608_lcn";
        // REPLACE with Database user password
        $password = "@Lcn11031996";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, sensor, location, value1, value2, time_act FROM SensorData ORDER BY id DESC";

        echo '<table cellspacing="5" cellpadding="5">
              <tr> 
                <td><b>ID</b></td> 
                <td><b>SENSOR</b></td> 
                <td><b>PLACEMENT</b></td> 
                <td><b>TEM1</b></td> 
                <td><b>TEM2</b></td>
                <td><b>TIME</b></td> 
              </tr>';

        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $row_id = $row["id"];
                $row_sensor = $row["sensor"];
                $row_location = $row["location"];
                $row_value1 = $row["value1"];
                $row_value2 = $row["value2"];
                $row_reading_time = $row["time_act"];
                // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
                //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));

                // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
                //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));

                echo '<tr> 
                        <td>' . $row_id . '</td> 
                        <td>' . $row_sensor . '</td> 
                        <td>' . $row_location . '</td> 
                        <td>' . $row_value1 . '</td> 
                        <td>' . $row_value2 . '</td>
                        <td>' . $row_reading_time . '</td> 
                      </tr>';
            }
            $result->free();
        }

        $conn->close();
        ?>
        </table>
    </div>
</body>

</html>