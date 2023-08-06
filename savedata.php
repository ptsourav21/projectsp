<?php

include 'conn.php';

$sqlGetFirstRow = "SELECT formName FROM field_value LIMIT 1";
$resultGetFirstRow = mysqli_query($conn, $sqlGetFirstRow);

if ($resultGetFirstRow) {
    $firstRow = mysqli_fetch_assoc($resultGetFirstRow);
    $formName = $firstRow['formName'];

    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS $formName (id INT AUTO_INCREMENT PRIMARY KEY)";
    if (mysqli_query($conn, $sqlCreateTable)) {
        echo "Table $formName created successfully!<br>";

        $sqlRetrieve = "SELECT * FROM field_value";
        $resultRetrieve = mysqli_query($conn, $sqlRetrieve);

        if ($resultRetrieve) {
            while ($row = mysqli_fetch_assoc($resultRetrieve)) {
                $keyName = $row["keyName"];
                $valueType = $row["valueType"];

                

                if (!empty($keyName) && !empty($valueType)) {
                    $sqlAlterTable = "ALTER TABLE $formName ADD $keyName '$valueType'";
                    if (mysqli_query($conn, $sqlAlterTable)) {
                        echo "Column $keyName added to table $formName with type $valueType<br>";
                    } else {
                        echo "Error adding column: " . mysqli_error($conn) . "<br>";
                    }
                } else {
                    echo "Key name or value type is empty.<br>";
                }
            }
        } else {
            echo "Error retrieving data: " . mysqli_error($conn) . "<br>";
        }
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "Error getting formName: " . mysqli_error($conn) . "<br>";
}

?>
