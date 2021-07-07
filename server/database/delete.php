<!-- Aim: To delete the record from the database.  -->


<?php
session_start();

require_once("config.php");

function redirect($data)
{
    header("location: " . $data);
}

if(isset($_POST['id']) && !empty($_POST['id']))
{
    $query =  "DELETE FROM " . TABLE_NAME . " WHERE Id=:id ;";

    if($stmt = $conn -> prepare($query))
    {
        $stmt -> bindParam(":id", $id);
        $id = trim($_POST['id']);

        if($stmt -> execute())
        {
            // upon proper execution, save the session message and redirect to index.php
            redirect("index.php");
            exit();
        }else
        {
            redirect("error.php");
            exit();
        }

        // close the statement
        unset($stmt);
    }

    // close the connection
    $conn = null;
}else
{
    if (empty(trim($_GET['id'])))
    {
        // redirect to error page if id is missing in the URL.
        redirect("error.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<style>
    .container
    {
        width: 600px;
        margin: 0 auto;
    }
</style>
<body>
    <!-- Contact Form -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5 mb-3">Delete Record</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="alert alert-danger text-center">
                        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>">
                        <p>Confirm to delete the record?</p>
                        <p>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="index.php" class="btn btn-secondary ml-2">No</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>        
    </div>
    

    <!-- Bootstrap JS File -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>