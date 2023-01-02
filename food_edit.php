<?php
include('security.php');

include('includes/header.php'); 
include('includes/navbar.php');  
?>

    <div clss="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Food Edit </h6>
            </div>
        </div>   
        <div class="card-body">


        <?php
    $connection = mysqli_connect("localhost", "root" , "", "adminpanel");


    if (isset($_POST['food_edit_btn']))
    {
        $id = $_POST['edit_id'];
    
        $query = "SELECT * FROM food WHERE id= '$id' ";
         $query_run = mysqli_query($connection, $query);
    
               foreach($query_run as $row)
    
    {
        
         ?>

                <form action="code.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="update_id" value="<?php echo $row['id'] ?>">
                
                    <div class="form-group">
                        <label> Name </label>
                        <input type="text" name="edit_name" value="<?php echo $row['pro_name']?>" class="form-control" >
                        
                    </div>

                    <div class="form-group">
                        <label> Food Type </label>
                        <input type="text" name="edit_food_type" value="<?php echo $row['fdtype']?>" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label> Description </label>
                        <input type="text" name="edit_description"  value="<?php echo $row['descrip']?>" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label> Price </label>
                        <input type="text" name="edit_price"  value="<?php echo $row['price']?>" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label> Upload Image </label>
                        <input type="file" name="edit_food_image"  id="edit_food_image" value="<?php echo $row['images']?>" class="form-control" >
                        
                    </div>

                    

                            <a href="food.php" class="btn btn-danger"> CANCEL </a>
                            <button type="submit" name="food_update_btn" class="btn btn-primary"> Update </button>
                            

            </form>

            <?php
       }
       
    }

    ?>

        </div>    
    </div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>