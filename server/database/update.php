<!-- Aim: to update the records in the database with html template -->


<?php
session_start();
ob_start();


require_once("config.php");




function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function redirect($url)
{
    header("location: " . $url);
    ob_end_flush();
    exit();
}



// Processing form data when form is submitted
if(isset($_GET['id']) && !empty(trim($_GET['id'])))
{
    if (isset($_POST['update_name']) && isset($_POST['update_email']) && isset($_POST['update_contact']))
    {
        // Get all input values
        $update_name = validate($_POST['update_name']);
        $update_email = validate($_POST['update_email']);
        $update_contact = validate($_POST['update_contact']);
        $update_dob = validate($_POST['update_dob']);
        $update_gender = validate($_POST['update_gender']);
        $update_city = validate($_POST['update_city']);
        $update_state = validate($_POST['update_state']);
        $update_current = validate($_POST['update_current']);
        $update_permanent = validate($_POST['update_permanent']);
        $id = $_GET["id"];

        if (!empty($update_name) && !empty($update_phone) && !empty($update_email))
        {
            // Prepare an update statement
            $query = "UPDATE " . TABLE_NAME . " SET Name= :update_name, Email = :update_email, Phone = :update_contact, DOB=:update_dob, Gender=:update_gender, City=:update_city, State=:update_state, Current=:update_current, Permanent=:update_permanent, Document=:update_document, Image=:update_image  WHERE Id = :id ;";

            if($stmt = $conn -> prepare($query))
            {
                // Bind variables to the prepared statement as parameters
                $stmt -> bindParam(":update_name", $update_name);
                $stmt -> bindParam(":update_email", $update_email);
                $stmt -> bindParam(":update_contact", $update_contact);
                $stmt -> bindParam(":update_dob", $update_dob);
                $stmt -> bindParam(":update_gender", $update_gender);
                $stmt -> bindParam(":update_city", $update_city);
                $stmt -> bindParam(":update_state", $update_state);
                $stmt -> bindParam(":update_current", $update_current);
                $stmt -> bindParam(":update_permanent", $update_permanent);
                $stmt -> bindParam(":update_document", $update_document);
                $stmt -> bindParam(":update_image", $update_image);
                $stmt -> bindParam(":id", $id);
                
                
                // Attempt to execute the prepared statement
                if($stmt -> exec())
                {
                    console.log("1");
                    // Records updated successfully. Redirect to landing page
                    $_SESSION['message'] = "Record Saved Successfully!";
                    redirect("index.php");
                    console.log("as");

                } else
                {
                    $_SESSION['message'] = "Query Execution Failed! Please try again. ";
                    redirect("error.php");
                }
                // Close statement
                unset($stmt);
            }
        }        
        // Close connection
        $conn = null;
    }else
    {
        $_SESSION['message'] = "The input fields cannot be empty! Please, click on Cancel Button to redirect to home page. ";
    }

} else
{
    // redirect to error page if URL doesn't contain id
    redirect("error.php");
}

?>




<!-- ------------------------------------------------------------------------------------------------------------- -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
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
</head>
<style>
    .container
    {
        width: 600px;
        margin: 0 auto;
    }
    .wrapper
    {
        width: 600px;
    }
</style>
<body>
    <div class="container wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 display-4 text-center">Admin: <small class="text-muted">Update Records</small></h1>
                <p>Please edit the input values and submit to update the record.</p>
                <form action="" method="POST" class="form" enctype="multipart/form-data">
                    <div class="form-group mt-3">
                        <label>Name</label>
                        <input type="text" name="update_name" class="form-control" value="" autofocus>
                    </div>
                    <div class="form-group mt-3">
                        <label>Email</label>
                        <input type="text" name="update_email" class="form-control" value="">
                    </div>
                    <div class="form-group mt-3">
                        <label>Contact</label>
                        <input type="text" name="update_contact" class="form-control" value="">
                    </div>
                    <div class="form-group mt-3">
                        <label>DOB</label>
                        <input type="date" name="update_dob" class="form-control" value="">
                    </div>
                    <div class="form-group mt-3">
                        <label>Gender</label>
                        <input type="text" name="update_gender" class="form-control" value="">
                    </div>
                    <div class="form-group mt-3">
                        <label>City</label>
                        <input type="text" name="update_city" class="form-control" value="">
                    </div>
                    <div class="form-group mt-3">
                        <label>State</label>
                        <select class="form-select" id="state" name="state" required>
                            <option selected value="Chandigarh">Chandigarh</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Mohali">Mohali</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label>Current Address</label>
                        <textarea name="update_current" class="form-control" rows="5" id="current"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label>Permanent Address</label>
                        <textarea name="update_permanent" class="form-control" rows="5" id="permanent"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label>Document</label>
                        <input type="file" name="update_document" class="form-control" value="">
                        <a href="" target="_blank" id="document">View Document file</a>
                    </div>
                    <div class="form-group mt-3">
                        <label>Image</label>
                        <input type="file" name="update_image" class="form-control" value="" accept="image/*">
                        <a href="" target="_blank" id="image">View Image file</a>
                    </div>
                    <input type="submit" class="btn btn-primary mt-4" value="Submit">
                    <a href="index.php" class="btn btn-secondary ml-2 mt-4">Cancel</a>
                </form>
            </div>
        </div> 
        <div>
            <p>
                <?php
                    if (isset($_SESSION['message']) && !empty($_SESSION['message']))
                    {
                        echo("<div class=\"alert alert-success my-4\">");
                        echo ($_SESSION['message']);
                        session_unset();
                        session_destroy();
                    }
                    ?>
                </p>
            </div>
        </div>
    </div>
    <script src="../update.js"></script>
</body>
</html>




