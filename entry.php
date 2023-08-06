<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entry Form</title>
    <link rel="stylesheet" href="mystyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <?php
    include 'conn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $columnNames = array();  // To store column names for generating labels and inserting data

        // Fetch column names from the specified form
        $formName = $_POST["formName"];
        ?>
        <h1>Enter Data for <?php echo $formName; ?></h1>
        <?php
        $sqlShowColumns = "SHOW COLUMNS FROM $formName";
        $resultShowColumns = mysqli_query($conn, $sqlShowColumns);

        if ($resultShowColumns && mysqli_num_rows($resultShowColumns) > 0) {
            while ($row = mysqli_fetch_assoc($resultShowColumns)) {
                if ($row['Field'] !== 'id') {  // Exclude the 'id' column
                    $columnNames[] = $row['Field'];
                }
            }

            // Generate and process the form
            echo "<form method='POST'>";
            foreach ($columnNames as $columnName) {
                echo "<div class='mb-3'>";
                echo "<label for='$columnName' class='form-label'>$columnName</label>";
                echo "<input type='text' class='form-control' id='$columnName' name='$columnName'>";
                echo "</div>";
            }
            echo "<input type='hidden' name='formName' value='$formName'>";
            echo "<button type='submit' class='btn btn-primary'>Submit</button>";
            echo "</form>";

            // Insert data into the specified form's table
            if (!empty($_POST)) {
                $values = array_map(array($conn, 'real_escape_string'), $_POST);
                array_pop($values);
                $insertColumns = implode(', ', $columnNames);
                $insertValues = "'" . implode("', '", $values) . "'";
                $sqlInsertData = "INSERT INTO $formName ($insertColumns) VALUES ($insertValues)";
                echo($sqlInsertData);
                if (mysqli_query($conn, $sqlInsertData)) {
                    echo "<p>Data successfully inserted into $formName table.</p>";
                    header("Location: openallforms.php");
                } else {
                    echo "<p>Error inserting data: " . mysqli_error($conn) . "</p>";
                }
            }
        } else {
            echo "<p>No columns found for the specified form.</p>";
        }
    } else {
        echo "<p>No form data specified.</p>";
    }
    ?>
</div>

</body>
</html>
