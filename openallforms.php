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

<h1>Existing Forms</h1>

<div class="container">
  <table class="table">
    <tbody>
      <?php
        include 'conn.php';
        
        $sqlSelectFormNames = "SELECT * FROM table_names";
        $resultSelectFormNames = mysqli_query($conn, $sqlSelectFormNames);
        
        if ($resultSelectFormNames) {
          $count = 1;
          while ($row = mysqli_fetch_assoc($resultSelectFormNames)) {
            $formName = $row['table_name'];
            echo "<tr>";
            echo "<th scope='row'>$count</th>";
            echo "<td>$formName</td>";
            echo "<td>
                    <form action='view.php' method='POST'>
                        <input type='hidden' name='formName' value='$formName'>
                        <input type='submit' class='btn btn-secondary' value='View'>
                    </form>
                  </td>";
            echo "<td>
                    <form action='entry.php' method='POST'>
                        <input type='hidden' name='formName' value='$formName'>
                        <input type='submit' class='btn btn-secondary' value='Entry'>
                    </form>
                  </td>";
            echo "</tr>";
            $count++;
          }
        } else {
          echo "<tr><td colspan='4'>Error retrieving form names: " . mysqli_error($conn) . "</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
