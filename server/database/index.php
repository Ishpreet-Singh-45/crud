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
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>

    <!-- Custom Script -->
    <script>
        $(document).ready(function ()
        {
            $("[data-toggle='tooltip']").tooltip();
        });
        function redirect(url)
        {
            window.location.replace("/Web/" + url);
        }
    </script>
</head>
<style>
    #goback
    {
        cursor: pointer;
        color: blue;
        margin-right: 40px;
        font-size: 1.3rem;
    }
</style>
<body>
    <div class="container-fluid" style="width: 1000px;">
        <div class="row mt-4">
            <div class="col-sm-12">
                <span class="bi bi-arrow-left-circle" id="goback" onclick="redirect('index.html')"> Home</span>
                <h1 class="text-center">Admin: Database Records</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center mt-4">
                    <a href="insert.php" class="btn btn-success"><i class="bi bi-plus-lg mr-2"></i>Add New Record</a>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="table-responsive">
                <?php
                require_once ("config.php");
                
                $query = "SELECT * from ". TABLE_NAME;
                if ($result = $conn -> query($query))
                {
                    if ($result -> rowCount() > 0)
                    {
                        echo (" <table class=\"table table-bordered\"> ");
                            echo (" <thead> ");
                                echo (" <tr> ");
                                    echo(" <th><b>#</b></th> ");
                                    echo(" <th><b>Name</b></th> ");
                                    echo(" <th><b>Email</b></th> ");
                                    echo(" <th><b>Contact</b></th> ");
                                    echo(" <th><b>Gender</b></th> ");
                                    echo(" <th><b>City</b></th> ");
                                    echo(" <th style='width: 200px;'><b>Operations</b></th> ");
                                echo(" </tr> ");
                            echo (" </thead> ");
                            echo (" <tbody> ");
                                while($row = $result -> fetch())
                                {
                                    echo (" <tr> ");
                                        echo (" <td> " . $row['Id'] . " </td> ");
                                        echo (" <td> " . $row['Name'] . " </td> ");
                                        echo (" <td> " . $row['Email'] . " </td> ");
                                        echo (" <td> " . $row['Phone'] . " </td> ");
                                        echo (" <td> " . $row['Gender'] . " </td> ");
                                        echo (" <td> " . $row['City'] . " </td> ");
                                        echo (" <td> "); 
                                            echo ("<a href= \"./view.php?id=" . $row['Id'] . "\" class=\"ms-3\" title=\"View Record\" data-toggle=\"tooltip\"><i class=\"bi bi-eye\"></i></a>");
                                            echo ("<a href=\"./update.php?id=" . $row['Id'] . "\" class= \"ms-3\" title=\"Update Record\" data-toggle=\"tooltip\"><i class=\"bi bi-pencil-square\"></i></a> ");
                                            echo ("<a href=\"./delete.php?id=" . $row['Id'] . "\" class= \"ms-3\" title=\"Delete Record\" data-toggle=\"tooltip\"><i class=\"bi bi-trash\"></i></a> ");
                                        echo ("</td>");
                                    echo("</tr>");
                                }
                            echo("</tbody>");
                        echo ("</table>");
                    }else
                    {
                        echo (" <div class=\"alert alert-danger\"><em>No Records were Found!</em></div> ");
                    }
                }else
                {
                    echo (" Oops! Something went wrong! Please try again later. ");
                }
                $conn = null;
                ?>
            </div>
        </div>
    </div>
</body>
</html>