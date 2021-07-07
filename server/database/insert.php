<!-- Aim:  To insert records into the database with html template -->



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
    header("location: ". $url);
    ob_end_flush();
    exit();
}

// if request method is post
if(($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST['submit']) && (!empty($_FILES['doc_file']['name'])) && (!empty($_FILES['image_file']['name'])))
{
    // gathering all data from the form. 
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    
    // check if all errors are empty
    if (!empty($name) && !empty($phone) && !empty($email))
    {
        $gender = validate($_POST['gender']);
        $city = validate($_POST['city']);
        $state = validate($_POST['state']);
        $dob = $_POST['date'] . "-" . $_POST['month'] . "-" . $_POST['year'];
        $current_addr = $_POST['current_addr'];
        $perm_addr = $_POST['perm_addr'];

        // Handling Doc and image files
        $doc_filename = basename($_FILES['doc_file']['name']); // name of file + extension
        $docDir = "../uploads/Documents/" . $doc_filename; // directory fo file -> path
        $docType = pathinfo($doc_filename, PATHINFO_EXTENSION); // only the extension

        $image_filename = basename($_FILES['image_file']['name']);
        $imageDir = "../uploads/Images/" . $image_filename;
        $imgType = pathinfo($image_filename, PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES['doc_file']['tmp_name'], $docDir) && move_uploaded_file($_FILES['image_file']['tmp_name'], $imageDir))
        {
            $query = "INSERT INTO " . TABLE_NAME . " (Name, Email, Phone, DOB, Gender, City, State, Current, Permanent, Document, Image) VALUES (:name, :email, :phone, :dob, :gender, :city, :state, :current_addr, :perm_addr, :doc_file, :image_file);";
            
            if ($stmt = $conn -> prepare($query))
            {
                
                $stmt -> bindParam(":name", $name);
                $stmt -> bindParam(":email", $email);
                $stmt -> bindParam(":phone", $phone);
                $stmt -> bindParam(":dob", $dob);
                $stmt -> bindParam(":gender", $gender);
                $stmt -> bindParam(":city", $city);
                $stmt -> bindParam(":state", $state);
                $stmt -> bindParam(":current_addr", $current_addr);
                $stmt -> bindParam(":perm_addr", $perm_addr);
                $stmt -> bindParam(":doc_file", $doc_filename);
                $stmt -> bindParam(":image_file", $image_filename);
                

                // if execution of the statement is true
                if($stmt -> execute())
                {
                    // after proper execution of the insertion query, redirect to index.php file and show a confirmation message 
                    $_SESSION['message'] = "Record Saved. ";
                    redirect("index.php");
                }else
                {
                    redirect("error.php");
                }
                // closing statement
                unset($stmt);
            }   
        }
        else
        {
            // Error Modal Code to be typed here. 
            echo("<div class=\"modal\" id=\"myModal\" tab-index=\"-1\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">");
                echo("<div class=\"modal-dialog\">");
                    echo("<div class=\"modal-content\">");
                        echo("<div class=\"modal-header\" id=\"modalHeaderAnimation\">");
                            echo("<h5 class=\"modal-title\" id=\"myModalLabel\">");
                                echo("Error <span class=\"bi bi-exclamation-lg\"></span>");
                            echo("</h5>");
                            echo("<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"close\"></button>");
                        echo("</div>");
                        echo("<div class=\"modal-body\">");
                            echo("<p class=\"display-6\" style=\"font-size: 1.5rem\">Please fill the form first. </p>");
                        echo("</div>");
                        echo("<div class=\"modal-footer\">");
                            echo("<button type=\"button\" class=\"btn btn-primary\" data-bs-dismiss=\"modal\">Okay</button>");
                        echo("</div>");
                    echo("</div>");
                echo("</div>");
            echo("</div>");
        }
        // close the connection
        $conn = null;
    }
}
// ---------------------------------------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit the Form. </title>
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
            $("#goback").css('color', 'blue');

            $('#modalHeaderAnimation').css("borderRadius", "10px");
            $('#myModalLabel').css("font-size", "1.5rem");
            $('#button').click(function()
            {
                var div = $("#modalHeaderAnimation");
                for (var i=0; i<3; i++)
                {
                    div.animate({
                        backgroundColor: "#f8d7da;",
                        margin: "10px"
                    });
                    div.animate({
                        backgroundColor: "#fff;",
                        margin: "10px"
                    }, 'slow');
                }
            });
            
        })
        function redirect(url)
        {
            window.location.replace("/Web/" + url);
        }
    </script>
</head>
<style>
    .container
    {
        width: 900px;
    }
    #submit, #cancel
    {
        box-shadow: 1px 2px 2px black;
        align-items: center;
    }
    #submit:hover, #cancel:hover
    {
        z-index: .8;
    }
    #submit:active, #cancel:active
    {
        box-shadow: none;
    }
    #goback
    {
        cursor: pointer;
        color: blue;
        margin-right: 40px;
        font-size: 1.3rem;
    }
    .file_input
    {
        border-radius: 5px;
    }
</style>
<body>
    <!-- Contact Form -->
    <?php
    $name = $email = $phone = $message = "";
    ?>


    <div class="container my-5">
        <span id="goback" class="bi bi-arrow-left-circle" onclick="redirect('index.html')"> Home</span>
        <form action="<?php echo (htmlspecialchars($_SERVER["PHP_SELF"])); ?>" method="POST" class="border p-4 pt-2" enctype="multipart/form-data" novalidate>
            <h1 class="display-5 text-center" id="form"><strong>Contact Form</strong></h1>
            <div class="row my-4">
                <!-- Name -->
                <div class="col-6">
                    <input id="name" class="form-control" placeholder="Name" name="name" required>
                    <div class="valid-feedback">Looks Good!</div>
                </div>
                <!-- Email -->
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                </div>
            </div>
            <div class="row my-4">
                <!-- Phone -->
                <div class="col-6">
                    <input type="text" placeholder="Contact Number" name="phone" id="phone" class="form-control" required>
                    <div class="valid-feedback">Looks Good!</div>
                </div>
                <!-- Gender -->
                <div class="col-6" style="transform: translate(35px, 5px);">
                    <div class="form-check-inline col-3 ms-4">
                        <input type="radio" class="form-check-input" name="gender" id="radio_male" value="Male" required>
                        <label for="radio_male" class="form-check-label">Male</label>
                        <div class="invalid-feedback">Please specify your Gender!</div>
                    </div>
                    <div class="form-check-inline col-3" style="margin-left: -45px;">
                        <input type="radio" class="form-check-input" name="gender" id="radio_female" value="Female" required>
                        <label for="radio_female" class="form-check-label">Female</label>
                        <div class="invalid-feedback">Please specify your Gender!</div>
                    </div>
                    <div class="form-check-inline col-3" style="margin-left: -25px;">
                        <input type="radio" class="form-check-input" name="gender" id="radio_other"value="Other" required>
                        <label for="radio_other" class="form-check-label">Other</label>
                        <div class="invalid-feedback">Please specify your Gender!</div>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <!-- City -->
                <div class="col-6">
                    <input type="text" class="form-control" name="city" placeholder="City">
                </div>
                <div class="col-3">
                    <select class="form-select" id="state" name="state" required>
                        <option selected value="Chandigarh">Chandigarh</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Mohali">Mohali</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid state.
                    </div>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip Code" required>
                    <div class="invalid-feedback">
                        Please enter a valid Zip Code!
                    </div>
                </div>
            </div>
            <!-- Date of Birth -->
            <div class="row my-4">
                <div class="col-2" style="transform: translateY(5px);">
                    <span><b>Date of Birth:</b></span>
                </div>

                <!-- Date Month Year -->
                <form class="col-9">
                    <div class="col-3">
                        <select class="form-select" id="date" name="date">
                            <option>Date</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select class="form-select" id="month" name="month">
                            <option>Month</option>
                            <option>January</option>
                            <option>February</option>
                            <option>March</option>
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option>July</option>
                            <option>August</option>
                            <option>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select class="form-select" id="year" name="year">
                            <option>Year</option>
                            <option>2000</option>
                            <option>2001</option>
                            <option>2002</option>
                            <option>2003</option>
                            <option>2004</option>
                            <option>2005</option>
                            <option>2006</option>
                            <option>2007</option>
                            <option>2008</option>
                            <option>2009</option>
                            <option>2010</option>
                        </select>
                    </div>
            </div>

            <!-- Current Address -->
            <div class="row my-4">
                <div class="col-6">
                    <textarea class="form-control" name="current_addr" placeholder="Current Residing Address" rows="5name="corres_addr" required></textarea>
                    <div class="invalid-feedback">
                        Please specify your Current Residing Address!
                    </div>
                </div>

                <!-- Permanent Address -->
                <div class="col-6">
                    <textarea class="form-control" name="perm_addr" placeholder="Permanent Address" rows="5" name="perm_addr" required></textarea>
                    <div class="invalid-feedback">
                        Please specify your Permanent Address!
                    </div>
                </div>
            </div>            

            <!-- Document File -->
            <div class="row my-4">
                <div class="input-group col-6">
                    <div class="col-3" style="transform: translateY(4px);">
                        <label for="doc_file" class="form-label"><strong>Document File :</strong></label>
                    </div>
                    <input type="file" class="form-control file_input" name="doc_file" id="doc_file">
                </div>
            </div>

            <!-- Image File -->
            <div class="row my-4">
                <div class="input-group col-6">
                    <div class="col-3" style="transform: translateY(4px);">
                        <label for="image_file" class="form-label">
                            <strong>Passport Size Photo :</strong>
                        </label>
                    </div>
                    <input type="file" class="form-control file_input" name="image_file" id="image_file" accept="image/*">
                </div>
                <small style="transform: translateY(-10px);">(Image Files only)</small>
            </div>

            <!-- Terms and Conditions -->
            <div class="row my-4">
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label for="terms" class="form-check-label">Agree to Terms and Conditions</label>
                        <div class="invalid-feedback">
                            You must agree to our Terms and Conditions to proceed further!
                        </div>
                    </div>
                </div>
            </div>
            <!-- Buttons -->
            <div class="d-flex justify-content-center my-4">
                <input id="submit" type="submit" class="btn btn-primary" value= "Submit" name="submit">  
                <a href="index.php" id="cancel" class="btn btn-secondary ms-3 p-2">Cancel</a>
            </div> 
        </form>
        <?php
            if (isset($_SESSION['message']))
            {
                echo ("<div class=\"alert alert-success\">");
                    echo ("<p>");
                        echo ($_SESSION['message']);
                        session_unset();
                        session_destroy();
                    echo ("</p>");
                echo ("</div>");
            }
        ?>
    </div>
</body>
</html>

