<?php
session_start();
ob_start();

require_once("./server/database/config.php");

if (isset($_POST['submit']) && !empty($_FILES['image_file']['name']))
{
    echo("22");
    $target_dir = "./server/uploads/";
    $file_name = basename($_FILES['image_file']['name']);
    $file_path = $target_dir . $file_name;
    $fileType = pathinfo($file_path, PATHINFO_EXTENSION);
    echo ($fileType);
    $allowTypes = array("jpg", "png", "jpeg");
    if (in_array($fileType, $allowTypes))
    {
        // Upload file to server not the database
        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $file_path))
        {
            // insert file name only into database
            $query = "INSERT INTO " . TABLE_NAME . "(Image) VALUES (:file);";

            if($stmt = $conn -> prepare($query))
            {
                $stmt -> bindParam(':file', $file_name);

                if ($stmt -> execute())
                {
                    $_SESSION['message'] = "File uploaded. ";
                }
            }
        }
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image file</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <form action="<?php echo (basename($_SERVER['PHP_SELF'])); ?>" method="POST" enctype="multipart/form-data">
                <label>Image: </label>
                <input type="file" class="form-control" name="image_file" accept="images/*">
                <input type="submit" value="submit" name="submit">
            </form>
            <p>
                <?php
                if (isset($_SESSION['message']))
                {
                    echo ($_SESSION['message']);
                    session_unset();
                    session_destroy();
                }
                ?>
            </p>
        </div>
    </div>
</body>
</html>
