<?php
        
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Access");

        $connection = mysqli_connect("localhost","root","","adminpanel");
        $qry_food = mysqli_query($connection,"select * from food");
        while($row = mysqli_fetch_array($qry_food))
        {
            $data[] = $row;
        }

        echo json_encode($data);



?>