<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Form</title>
    <link rel="stylesheet" href="mystyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: gray;
            color: white;
        }

        .container {
            margin-top: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .table {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h1>View Form Data</h1>

<div class="container">
    <?php
    include 'conn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $formName = $_POST["formName"];

        $sqlSelectFormData = "SELECT * FROM $formName";
        $resultSelectFormData = mysqli_query($conn, $sqlSelectFormData);

        if ($resultSelectFormData && mysqli_num_rows($resultSelectFormData) > 0) {

            $firstRow = mysqli_fetch_assoc($resultSelectFormData);
            $columnNames = array_keys($firstRow);

            echo "<table class='table'>";
            echo "<thead><tr>";

            foreach ($columnNames as $columnName) {
                echo "<th scope='col'>$columnName</th>";
            }

            echo "</tr></thead><tbody>";
            mysqli_data_seek($resultSelectFormData, 0);

            while ($row = mysqli_fetch_assoc($resultSelectFormData)) {
                echo "<tr>";
                foreach ($columnNames as $columnName) {
                    $value = $row[$columnName];
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<p>No data available for the selected form.</p>";
        }
    } else {
        echo "<p>No form data specified.</p>";
    }
    ?>
</div>

</body>
</html>
