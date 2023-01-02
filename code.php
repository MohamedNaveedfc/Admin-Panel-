<?php
include('security.php');
session_start();

if(isset($_POST['save_food']))
{
    $pro_name = $_POST['food_name'];
    $fdtype = $_POST['food_type_name'];
    $description = $_POST['food_description'];
    $images = $_FILES["food_image"]['name'];
    $price = $_FILES["food_price"]['name'];

    $validate_img_extension = $_FILES["food_image"]["type"] == "image/jpg" ||
    $_FILES["food_image"]["type"] == "image/png" ||
    $_FILES["food_image"]["type"] == "image/jpeg"||
    $_FILES["food_image"]["type"] == "image/webp";

    if($validate_img_extension)
    {

            if(file_exists("upload/" . $_FILES["food_image"]["name"]))
            {
                $store = $_FILES["food_image"]["name"];
                $_SESSION['status']= "Image already exists. '.$store.'";
                header('Location: food.php');
            }

            else
            {

                $query = "INSERT INTO food (`pro_name`,`fdtype`,`descrip`,`images`,`price`) VALUES ('$pro_name',' $fdtype','$description',' $images','$price')";
                $query_run = mysqli_query($connection, $query);

                if(query_run)
                {
                    move_uploaded_file($_FILES["food_image"]["tmp_name"], "upload/".$_FILES["food_image"]["name"]);
                    $_SESSION['success'] = "Food Added";
                    header("Location: food.php");
                }
                else
                {
                    $_SESSION['success'] = "Food Not Added";
                    header("Location: food.php");

                }

            }
        }
        else
        {
        $_SESSION['success'] = "ONly png,jpg,jpeg,webp images are allowed";
        header("Location: food.php");
    }
    

}

//* Delete page*//
if(isset($_POST['delete_food_btn']))
{
    $id = $_POST['delete_food_id'];

    $query = "DELETE FROM food WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Food Data is Deleted";
       // $_SESSION['status_code'] = "success";
        header('Location: food.php'); 
    }
    else
    {
        $_SESSION['status'] = "Food Data is NOT DELETED";       
        //$_SESSION['status_code'] = "error";
        header('Location: food.php'); 
    }    
}


//* food Update btn*//
if(isset($_POST['food_update_btn']))

{   
    print_r($_FILES);
    print_r($_POST);
    $update_id = $_POST['update_id'];
    $edit_name = $_POST['edit_name'];
    $edit_food_type = $_POST['edit_food_type'];
    $edit_description = $_POST['edit_description'];
    $edit_price = $_POST['edit_price'];
    
    $edit_food_image = $_FILES["edit_food_image"]['name'];

    $food_quary = "SELECT * FROM food WHERE id='$update_id'"; 
    $food_query_run = mysqli_query($connection, $food_quary);
    foreach($food_query_run as $fa_row)
    {
        // echo $fa_row['images'];
        if($edit_food_image == NULL)
        {
            //Update with existing Image
            $image_data = $fa_row['images'];
        }
        else
        {
            //Update with new image  and delete with old image
           $img_path = "upload/".$fa_row['images'];
           if(file_exists($img_path)){
            unlink($img_path);
            $image_data = $edit_food_image;
           }
            
        }
    }

    
    $query = "UPDATE food SET pro_name='$edit_name', fdtype='$edit_food_type', descrip='$edit_description',images='$edit_food_image',price='$edit_price' WHERE id='$update_id '";
    $query_run = mysqli_query($connection, $query);
    print_r($_POST);
    print_r($query_run);

    if($query_run)
        {
            if($edit_food_image == NULL)
            {
                //Update with existing Image
                $_SESSION['success'] = "Food  Updated existing Image";
                header("Location: food.php"); 
            }
            else
            {
                //Update with new image  and delete with old image
                move_uploaded_file($_FILES["edit_food_image"]["tmp_name"], "upload/".$_FILES["edit_food_image"]["name"]);
                $_SESSION['success'] = "Food Data is Updated";
                header("Location: food.php"); 
            }
            }
           
        else
        {
            $_SESSION['status'] = "Food Not Updated ";
            header("Location: food.php");   
        }
}









if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);


    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO register (username,email,password) VALUES ('$username','$email','$password')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['success'] = "Admin Profile Added";
               // $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                //$_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
           // $_SESSION['status_code'] = "warning";
            header('Location: register.php');  
        }
    }

}




//* Update page*//
if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query = "UPDATE register SET username='$username', email='$email', password='$password' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Your Data is Updated";
        //$_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        //$_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }
}



//* Delete page*//
if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Your Data is Deleted";
       // $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        //$_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }    
}



//*Login page*//
if(isset($_POST['login_btn']))
{
    $email_login = $_POST['email']; 
    $password_login = $_POST['password']; 

    $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' ";
    $query_run = mysqli_query($connection, $query);

   if(mysqli_fetch_array($query_run))
   {
        $_SESSION['username'] = $email_login;
        header('Location: index.php');
   } 
   else
   {
        $_SESSION['status'] = "Email / Password is Invalid";
        header('Location: login.php');
   }
    
}



?> 