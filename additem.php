<?php

include("config/db_connect.php");
//outofthe box php method for $_GET(Associative array) to see if the submit has been initialized
//so the if statement will only work if user has submitted something
//Global variables are set as $_ (dollar sign underscore)
$price = $name = $company = $description  ='' ;
$type = '';
$file_tmp= $file_name = NULL;
$errors = array('name'=>'', 'price'=>'' , 'company' =>'', 'description' =>'', 'type' => '', 'file' => '');

if(isset($_POST['submit'])){
    if(empty($_POST['name'])){
        $errors['name'] = 'Name Required <br /> ';
    }
    else {
        $name = $_POST['name'];
        if(!preg_match('/^[a-zA-Z0-9\s]+/', $name)){
            $errors['name']  =  'Name must be only Letters, numbers, and spaces ';
        }
    }
    if(empty($_POST['price'])){
        $errors['price'] = 'price Required <br /> ';
    }
    else {   
        $price = $_POST['price'];
        if(!preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $price    )){
            $errors['price']  =  'Price must be a valid decimal';
        }
    }
    if(empty($_POST['company'])){
        $errors['company'] = 'Company Required <br /> ';
    }
    else {
        $company = $_POST['company'];
        if(!preg_match('/^[a-zA-Z\s]+/', $company)){
        $errors['company']  =  'must be only Letters and spaces';
        }
    }
    if(empty($_POST['description'])){
        $errors['description'] = 'Description Required <br /> ';
    }
    else {
        $description = $_POST['description'];
        if(!preg_match('/^[a-zA-Z0-9\s]*+/', $description)){
            $errors['description']  =  'Name must be only Letters, numbers, and spaces ';
        }
    }
    if(empty($_POST['type'])){
        $errors['type'] = 'Type Required <br /> ';
    }
    else {
        $type = $_POST['type'];
    }

    if(!empty($_FILES['fileUploaded']['name'])){
        $file_name = $_FILES['fileUploaded']['name'];
        
      $file_size =$_FILES['fileUploaded']['size'];
      $file_tmp =$_FILES['fileUploaded']['tmp_name'];
      
      $file_type=$_FILES['fileUploaded']['type']; 
      $tmp = explode('.',$_FILES['fileUploaded']['name']);
      $file_ext= (end($tmp));
      $extensions= array("jpeg","jpg","png", "bmp");

      if(file_exists('img/'.$file_name)){
        $errors['file'] = "File name already exists";
      }

      if(in_array($file_ext,$extensions)=== false){
        $errors['file']="extension not allowed, please choose a JPEG or PNG file.";
     }
     
     if($file_size > 5097152){
        $errors['file']='File size must be below 5 MB';
     }

    }

   if(array_filter($errors)){

    }
    else{
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $company = mysqli_real_escape_string($conn, $_POST['company']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $file_name = !empty($file_name) ? 'img/'. $file_name : 'img/7rnrpyj4.bmp';
        $file_name  = mysqli_real_escape_string($conn,$file_name);

        $sql = "INSERT INTO product (p_name, p_price, p_company, p_description, p_type, p_file) VALUES ('$name', '$price', '$company', '$description', '$type', '$file_name'); ";
       
       if(mysqli_query($conn,$sql)){

         if(!empty($_FILES['fileUploaded']['name'])){
             
             move_uploaded_file($file_tmp,$file_name);
         }
        header('Location:index.php');
       }
       else{
           echo 'Query Error : ' . mysqli_error($conn).' PLease refresh page';
       }
    }


} // end of the post check 

?>






<!DOCTYPE html>
<html>

<?php include("templates/header.php"); ?>
<?php include("templates/footer.php"); ?>

    <section class="container grey-text">
        <h4 class="center">Add an item</h4>
        <form action="additem.php" method ="POST" class="white" enctype = "multipart/form-data">
            <label for="">Product Name</label>
            <input type="text" name = "name" value = "<?php echo $name ?>">
            <div class="red-text"><?php echo $errors['name']; ?></div>
            <label for="">Price</label>
            <input type="text" name = "price"  value = "<?php echo $price ?>">
            <div class="red-text"><?php echo $errors['price']; ?></div>
            <label for="">company</label>
            <input type="text" name = "company"  value = "<?php echo $company ?>">
            <div class="red-text"><?php echo $errors['company']; ?></div>   
            <label for="">Item Description</label>
            <input type="text" name = "description"  value = "<?php echo $description ?>">
            <div class="red-text"><?php echo $errors['description']; ?></div>
            <div class="row">
                <select name = "type" class ="browser-default">
                    <option  value="" disabled selected>Choose Product Type</option>
                    <option  value="SNACK">Snack</option>
                    <option  value="BEVERAGE">Beverage</option>
                    <option  value="CANDY">Candy</option>
                    <option  value="FROZEN">Frozen</option>
                    <option  value="LIQUOR">Liquor</option>
                </select>
            </div>
            <label for="">File image (optional)</label><br>
            <input type="file" name = "fileUploaded" >
            <div class ="red-text"> <?php echo $errors['file']; ?></div>
            
            <div class="center">
                <input type="submit" name ="submit" class="btn brand z-depth-0" value = "submit">
            </div>
        </form>
    </section>
</html>