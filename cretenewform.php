<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="mystyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <?php 

    include 'conn.php';

    ?>
    <?php

        $sqlCheckTable = "SELECT COUNT(*) AS count FROM field_value";
        $resultCheckTable = mysqli_query($conn, $sqlCheckTable);
        $tableNotEmpty = false;

        if ($resultCheckTable) {
            $row = mysqli_fetch_assoc($resultCheckTable);
            if ($row['count'] > 0) {
                $tableNotEmpty = true;
            }
        }

        $tableName = '';

        if ($tableNotEmpty) {
            $sqlGetFirstRow = "SELECT formName FROM field_value LIMIT 1";
            $resultGetFirstRow = mysqli_query($conn, $sqlGetFirstRow);
        
            if ($resultGetFirstRow) {
                $firstRow = mysqli_fetch_assoc($resultGetFirstRow);
                $tableName = $firstRow['formName'];
            } 
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            $formName = ($tableName == '') ? $_POST["formName"] : $tableName;
            $keyName = $_POST["keyName"];
            $valueType = $_POST["keyValue"];

            $formData = array(
                "formName" => $formName,
                "keyName" => $keyName,
                "valueType" => $valueType
            );

            $sql = "INSERT INTO field_value (formName, keyName, valueType) VALUES ('$formName', '$keyName', '$valueType')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "Form data inserted successfully!";
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            $allData = array();
            $sqlRetrieve = "SELECT * FROM field_value";
            $resultRetrieve = mysqli_query($conn, $sqlRetrieve);
            if ($resultRetrieve) {
                while ($row = mysqli_fetch_assoc($resultRetrieve)) {
                    $allData[] = $row;
                }
            }
        }
        ?>

        <div class="container">
            <h1>New Form Creation</h1>
            <?php
            if (!empty($allData)) {
                echo "<ul>";
                foreach ($allData as $data) {
                    echo "<li>Key Name: " . $data["keyName"] . "</li>";
                    echo "<li>Value Type: " . $data["valueType"] . "</li>";
                    echo "<br>";
                }
                echo "</ul>";
            }
            ?>
            <form action="" method="POST">
                <input type="text" name="formName" placeholder="Form Name" <?php if ($tableNotEmpty) echo "disabled"; ?>><br><br>

                <input type="text" name="keyName" placeholder="Key Name"><br><br>

                <select id="valueType" name="keyValue" placeholder="Select Value Type">
                    <option value="INT">Text/String</option>
                    <option value="VARCHAR(255)">Number</option>
                </select>
                <input type="submit" name="submit" value="+">
            </form>
            <form action="savedata.php" method="POST">
                <input type="submit" value="Submit" <?php if (!$tableNotEmpty) echo "disabled"; ?>>
            </form>
        </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>