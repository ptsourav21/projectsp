<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Existing Forms</title>
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
    }

    .table {
      background-color: white;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .btn-secondary {
      background-color: gray;
      border: none;
    }

    .btn-secondary:hover {
      background-color: darkgray;
    }
  </style>
</head>
<body>

<h1>Existing Forms</h1>

<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Form Name</th>
        <th>View</th>
        <th>Entry</th>
      </tr>
    </thead>
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
                        <input type='hidden' name='formName' value='$formName' >
                        <button type='submit' class='btn btn-secondary'>View</button>
                    </form>
                  </td>";
            echo "<td>
                    <form action='entry.php' method='POST'>
                        <input type='hidden' name='formName' value='$formName'>
                        <button type='submit' class='btn btn-secondary'>Entry</button>
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
