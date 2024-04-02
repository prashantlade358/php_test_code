<?php
include ('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file'])) {
    $username = $_POST['username'];
    $filename = $_FILES['file']['name'];
    $filedata = addslashes(file_get_contents($_FILES['file']['tmp_name']));

    $sql = "SELECT id FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        $sql_insert = "INSERT INTO files (user_id, filename, filedata) VALUES ('$user_id', '$filename', '$filedata')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "<center><h3>File uploaded successfully!</h3></center>";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Upload File</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Upload Files</h2>
    <form method="post" action="" enctype="multipart/form-data">
    <label class="form-label">Username:</label>
    <input type="text" name="username" required><br>

    <label class="form-label">Select file to upload:</label>
    <input type="file" name="file"  class="form-control" required /><br>
    <button type="submit" class="btn btn-success">Upload File</button>
    <a class="btn btn-primary" href="register.php" role="button">Home</a>
    
    </form>
</div>

</body>
</html>
