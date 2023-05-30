<?php
// Database connection credentials
$servername = "donuoctrieuduong.xyz";
$username = "don62637_don62637";
$password = "BeKi#7VeVe#8GiJa";
$dbname = "don62637_water_lever";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST data exists
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postData = json_decode(file_get_contents('php://input'), true);
    
    // Verify if the data is in the expected JSON format
    if ($postData !== null) {
        // Define the table name based on the date in the POST data
        $date = date("m_Y");
        $tableName = "water_level_" . $date;
        $columnNames = array_keys($postData);
        // SQL query to check if table exists
        $tableExistsQuery = "SHOW TABLES LIKE '$tableName'";

        $tableExistsResult = $conn->query($tableExistsQuery);
        
        if ($tableExistsResult->num_rows > 0) {
            echo "Table $tableName already exists.";
        } else {
            // Extract the column names from the POST data
            
            
            // Generate the CREATE TABLE query dynamically
            $createTableQuery = "CREATE TABLE $tableName (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
            
            foreach ($columnNames as $columnName) {
                    $createTableQuery .= ", $columnName VARCHAR(255)";
            }
            
            $createTableQuery .= ")";
            echo "cmd query: $createTableQuery end"; 
            if ($conn->query($createTableQuery) === TRUE) {
                echo "Table $tableName created successfully.";
            } else {
                echo "Error creating table: " . $conn->error;
            }
        }
        
        // Prepare the INSERT statement
        $insertQuery = "INSERT INTO $tableName (";
        
        foreach ($columnNames as $columnName) {
            $insertQuery .= "$columnName, ";
        }
        
        $insertQuery = rtrim($insertQuery, ", ");
        $insertQuery .= ") VALUES (";
        
        foreach ($columnNames as $columnName) {
                $insertQuery .= "'" . $postData[$columnName] . "', ";
            
        }
        
        $insertQuery = rtrim($insertQuery, ", ");
        $insertQuery .= ")";
        
        // Execute the INSERT statement
        if ($conn->query($insertQuery) === TRUE) {
            echo "Data inserted successfully.";
        } else {
            echo "Error inserting data: " . $conn->error;
        }
    } else {
        echo "Invalid JSON data.";
    }
} else {
    echo "No POST data received.";
}

// Close the database connection
$conn->close();
?>
