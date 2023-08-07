<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Sp</title>
    <link rel="stylesheet" href="mystyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .container.bodycontainer {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .btn-custom {
            background-color: gray;
            color: white;
            font-size: 24px;
            padding: 20px 40px;
            margin: 10px;
            border: none;
        }
    </style>
  </head>
  <body>
    <?php include 'conn.php' ?>

    <div class="container bodycontainer">
        <a class="btn btn-custom" href="cretenewform.php">Create New Form</a>
        <a class="btn btn-custom" href="openallforms.php">Open Existing Forms</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>