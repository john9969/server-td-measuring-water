<!DOCTYPE html>
<html>
<head>
    <title>Database Table with Bootstrap</title>
    <!-- Add the Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Máy đo Nước</h1>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Time</th>
                    <th>Water Level</th>
                    <th>Vol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Connect to the database
                    $servername = "donuoctrieuduong.xyz";
                    $username = "don62637_don62637";
                    $password = "BeKi#7VeVe#8GiJa";
                    $dbname = "don62637_water_lever";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $date = date("m_Y");
                    $tableName = "water_level_" . $date;
                    // Fetch data from the database
                    $sql = "SELECT * FROM  $tableName ORDER BY id DESC";
                    
                    $result = $conn->query($sql);
                    // Display rows up to a maximum of 20
                    $row_count = 0;
                    while ($row = $result->fetch_assoc()) {
                        if ($row_count >= 40) {
                            break;
                        }
                        $row_count++;
                        
                        // Output row data
                        echo "<tr>";
                        echo "<td>" . $row['date_time'] . "</td>";
                        echo "<td>" . $row['water_lever_0'] . "</td>";
                        echo "<td>" . ($row['vol']*37/1000) . "</td>";
                        echo "</tr>";
                    }

                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add the Bootstrap JS scripts (jQuery and Bootstrap) at the end of the body section -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
