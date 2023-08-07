<?php
include 'conn.php';

$tableNotEmpty = false;
$allData = [];



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $formName = ($_POST["formName"] ?? '');

    if (empty($formName)) {
        $query = "SELECT formName FROM field_value LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            
            // Get the formName value from the first row
            $formName = $row['formName'];
            
            // Use $formNameModified for further processing if needed
        } else {
            echo "Query failed: " . mysqli_error($conn);
        }
    }

    $keyName = $_POST["keyName"];
    $valueType = $_POST["keyValue"];

    $sql = "INSERT INTO field_value (formName, keyName, valueType) VALUES ('$formName', '$keyName', '$valueType')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $sqlCheckTable = "SELECT COUNT(*) AS count FROM field_value";
    $resultCheckTable = mysqli_query($conn, $sqlCheckTable);

    if ($resultCheckTable && ($row = mysqli_fetch_assoc($resultCheckTable))) {
        $tableNotEmpty = ($row['count'] > 0);
    }
}

if ($tableNotEmpty) {
    $sqlRetrieve = "SELECT * FROM field_value";
    $resultRetrieve = mysqli_query($conn, $sqlRetrieve);

    while ($row = mysqli_fetch_assoc($resultRetrieve)) {
        $allData[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Form Creation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f7f7f7;
        }

        .form-container {
            background-color: gray;
            padding: 30px;
            border-radius: 10px;
            width: 80%;
            max-width: 800px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-custom {
            background-color: gray;
            color: white;
            font-size: 18px;
            padding: 14px 28px;
            border: none;
        }

        .form-inline {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            align-items: center;
        }

        .form-inline select,
        .form-inline input[type="text"] {
            flex: 1;
            padding: 14px;
            font-size: 18px;
        }

        .submit-button {
            text-align: right;
            margin-top: 20px;
        }

        .form-data {
            list-style: none;
            font-size: 18px;
            display: inline-block;
            margin: 0;
            padding: 0;
        }

        .form-data li {
            display: inline;
            margin-right: 15px;
        }
        input[type="text"][name="formName"] {
            padding: 18px;
            font-size: 15px;
            margin-bottom:20px;
            width: 660px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2>New Form Creation</h2>
        </div>
        
        <form action="" method="POST">
            <input type="text" name="formName" placeholder="Form Name" <?= ($tableNotEmpty ? 'disabled' : '') ?>>
           <div>
           <?php
        if (!empty($allData)) {
            echo "<ul class='form-data'>";
            foreach ($allData as $data) {
                echo "<li>Key Name: " . $data["keyName"] . " | Value Type: " . $data["valueType"] . "</li><br>";
            }
            echo "</ul>";
        }
        ?>
           </div>
            <div class="form-inline">
                <input type="text" name="keyName" placeholder="Key Name">
                <select id="valueType" name="keyValue">
                    <option value="VARCHAR(255)">Text/String</option>
                    <option value="INT">Number</option>
                </select>
                <input type="submit" name="submit" value="Add" class="btn-custom">
            </div>
        </form>
        <form action="savedata.php" method="POST">
            <div class="submit-button">
                <input type="submit" value="Submit" <?= (!$tableNotEmpty ? 'disabled' : '') ?> class="btn-custom">
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
