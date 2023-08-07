<?php

include 'conn.php';

$sqlGetFirstRow = "SELECT formName FROM field_value LIMIT 1";
$resultGetFirstRow = mysqli_query($conn, $sqlGetFirstRow);

if ($resultGetFirstRow) {
    $firstRow = mysqli_fetch_assoc($resultGetFirstRow);
    $formName = $firstRow['formName'];
    $formName = strtolower($formName);
    $formName = str_replace(' ', '_', $formName);

    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS `$formName` (id INT AUTO_INCREMENT PRIMARY KEY)";
    if (mysqli_query($conn, $sqlCreateTable)) {
        echo "Table $formName created successfully!<br>";

        $sqlRetrieve = "SELECT * FROM field_value";
        $resultRetrieve = mysqli_query($conn, $sqlRetrieve);

        if ($resultRetrieve) {
            while ($row = mysqli_fetch_assoc($resultRetrieve)) {
                $keyName = $row["keyName"];
                $valueType = $row["valueType"];

                if (!empty($keyName) && !empty($valueType)) {
                    if ($valueType == 'VARCHAR(255)') {
                        $sqlAlterTable = "ALTER TABLE `$formName` ADD `$keyName` VARCHAR(255)";
                    } elseif ($valueType == 'INT') {
                        $sqlAlterTable = "ALTER TABLE `$formName` ADD `$keyName` INT";
                    } else {
                        echo "Unsupported data type: $valueType";
                    }
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

$sqlDeleteValues = "DELETE FROM field_value";
if (mysqli_query($conn, $sqlDeleteValues)) {
    echo "All values deleted from field_value table<br>";
} else {
    echo "Error deleting values: " . mysqli_error($conn) . "<br>";
}

$sqlInsertTableName = "INSERT INTO table_names (table_name) VALUES ('$formName')";
if (mysqli_query($conn, $sqlInsertTableName)) {
    echo "Form name '$formName' inserted into table_names<br>";
} else {
    echo "Error inserting form name: " . mysqli_error($conn) . "<br>";
}

header("Location: openallforms.php");
exit; 

?>
