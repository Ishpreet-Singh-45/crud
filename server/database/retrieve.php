<?php
require_once("config.php");


if(isset($_GET['id']) && !empty(trim($_GET['id'])))
{
    $query = "SELECT * FROM " . TABLE_NAME . " WHERE id=:id";

    if($stmt = $conn -> prepare($query))
    {
        $stmt -> bindParam(":id", $_GET['id']);
        if($stmt -> execute())
        {
            $row = $stmt -> fetch(PDO::FETCH_ASSOC);
            $data = $row;
        }
        
    }else
    {
        $data = array("error" => "Error in query, please try again. ");
    }
}else
{
    $data = array("error" => "Error in getting id. Please try again. ");
}


echo json_encode($data);


?>