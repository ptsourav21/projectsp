<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entry Form</title>
    <link rel="stylesheet" href="mystyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f7f7f7;
        }
        
        .container {
            background-color: gray;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        
        .mb-3 {
            margin-bottom: 20px;
        }
        
        .btn-primary {
            background-color: gray;
            border: none;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    include 'conn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $columnNames = array();
        $formName = strtolower($_POST["formName"]);
        ?>
        <h1 style="color: white;">Enter Data for <?php echo $formName; ?></h1>
        <?php
        $sqlShowColumns = "SHOW COLUMNS FROM $formName";
        $resultShowColumns = mysqli_query($conn, $sqlShowColumns);

        if ($resultShowColumns && mysqli_num_rows($resultShowColumns) > 0) {
            echo "<form method='POST'>";
            while ($row = mysqli_fetch_assoc($resultShowColumns)) {
                if ($row['Field'] !== 'id') {
                    $columnName = $row['Field'];
                    echo "<div class='mb-3'>";
                    echo "<label for='$columnName' class='form-label'>$columnName</label>";
                    echo "<input type='text' class='form-control' id='$columnName' name='$columnName'>";
                    echo "</div>";
                    $columnNames[] = $columnName;
                }
            }
            echo "<input type='hidden' name='formName' value='$formName'>";
            echo "<button type='submit' class='btn btn-primary'>Submit</button>";
            echo "</form>";

            if (!empty($_POST)) {
                $values = array_map(array($conn, 'real_escape_string'), $_POST);
                array_pop($values);
                $insertColumns = implode(', ', $columnNames);
                $insertValues = "'" . implode("', '", $values) . "'";
                $sqlInsertData = "INSERT INTO $formName ($insertColumns) VALUES ($insertValues)";
                if (mysqli_query($conn, $sqlInsertData)) {
                    echo "<p style='color: white;'>Data successfully inserted into $formName table.</p>";
                    header("Location: openallforms.php");
                    exit();
                } else {
                    echo "<p style='color: white;'>Error inserting data: " . mysqli_error($conn) . "</p>";
                }
            }
        } else {
            echo "<p style='color: white;'>No columns found for the specified form.</p>";
        }
    } else {
        echo "<p style='color: white;'>No form data specified.</p>";
    }
    ?>
</div>

</body>
</html>
