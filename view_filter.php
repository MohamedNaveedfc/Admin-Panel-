<?php

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: access");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
			
			
		$con = mysqli_connect("localhost","root","","adminpanel");
		
		$res = mysqli_query($con,"select * from food");

		while($row = mysqli_fetch_array($res))
		{
			$data[] = $row;
		}
		
		echo json_encode($data);

?>