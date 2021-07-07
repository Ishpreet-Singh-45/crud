<?php
    ob_start();
    session_start();

    function redirect($url)
    {
        header("location: ". $url);
        ob_end_flush();
        exit();
    }

    if (isset($_GET['id']) && !empty(trim($_GET['id'])))
    {
        require_once("config.php");
        
        $id = trim($_GET['id']);

        $query = "SELECT * FROM " . TABLE_NAME . " WHERE Id = :id;";


        if ($stmt = $conn -> prepare($query))
        {
            $stmt -> bindParam(":id", $id);

            if ($stmt -> execute())
            {
                if ($stmt -> rowCount() == 1)
                {
                    $row = $stmt -> fetch(PDO::FETCH_ASSOC);
                    
                    $docURL = "../uploads/Documents/" . $row['Document'];
                    $imageURL = "../uploads/Images/" . $row['Image'];
                    
                }else
                {
                    redirect("error.php");
                }
            }else
            {
                redirect("error.php");
            }
            // close the statement
            unset($stmt);
        }
        // close the connection
        $conn = null;
    }else
    {
        redirect("error.php");
    }
?>





<!-- -------------------------------------------------------------------------------- -->





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Records</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <!-- Bootstrap Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function()
        {
            $("#backButton").click(function()
            {
                window.location.replace("/Web/server/database/index.php");
            });
        });
    </script>
</head>
<style>
    .container
    {
        width: 600px;
        margin-bottom: 250px;
    }
</style>
<body>
    <div class="container-fluid">
        <div class="row mt-3 mb-4">
            <h1 class="text-center">View Record</h1>
        </div>
    </div>
    <div class="container">
        <div class="row" style="left: 400px;">
            <div class="mt-4 form-group">
                <label>Name:</label>
                <p class="ms-4">
                    <b><?php echo($row['Name']); ?></b>
                </p>
            </div>
            <div class="mt-4 form-group">
                <label>Email: </label>
                <p class="ms-4">
                    <b><?php echo($row['Email']); ?></b>
                </p>
            </div>
            <div class="mt-4 form-group">
                <label>Contact Number: </label>
                <p class="ms-4">
                    <b><?php echo($row['Phone']); ?></b>
                </p>
            </div>
            <div class="mt-4 form-group">
                <label>Date of Birth: </label>
                <p class="ms-4">
                    <b><?php echo($row['DOB']); ?></b>
                </p>
            </div>
            <div class="mt-4 form-group">
                <label>Gender: </label>
                <p class="ms-4">
                    <b><?php echo($row['Gender']); ?></b>
                </p>
            </div>
            <div class="mt-4 form-group">
                <label>City: </label>
                <p class="ms-4">
                    <b><?php echo($row['City']); ?></b>
                </p>
            </div>
            <div class="mt-4 form-group">
                <label>State: </label>
                <p class="ms-4">
                    <b><?php echo($row['State']); ?></b>
                </p> 
            </div>
            <div class="mt-4 form-group">
                <label>Current Address: </label>
                <p class="ms-4">
                    <b><?php echo($row['Current']); ?></b>
                </p> 
            </div>
            <div class="mt-4 form-group">
                <label>Permanent Address: </label>
                <p class="ms-4">
                    <b><?php echo($row['Permanent']); ?></b>
                </p> 
            </div>
            <div class="mt-4 form-group">
                <label>Document File: </label>
                <p class="ms-4">
                    <b>
                        <?php 
                            echo ("<a href=\"" . $docURL . "\" target=\"_blank\">View Doc File</a>");
                        ?>
                    </b>
                </p> 
            </div>
            <div class="mt-4 form-group">
                <label>Image File: </label>
                <p class="ms-4">
                    <?php
                        echo("<img src=\"" . $imageURL . "\" alt=\"\" style=\"width: 400px; height: 200px;\">");
                    ?>
                </p> 
                <a href="<?php echo $imageURL; ?>" target="_blank" class="ms-5">View Full Image File</a>
            </div>
        </div>
        <button type="button" class="btn btn-primary my-5" id="backButton">Back</button>
    </div>
</body>
</html>