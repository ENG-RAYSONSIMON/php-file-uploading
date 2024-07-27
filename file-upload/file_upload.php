<?php
if(isset($_POST['submit'])){

    
     $allowed_ext=  array('png','jpg','jpeg','gif');

    if(!empty($_FILES['uploads']['name'])){
        $form_data = $_FILES['uploads'];
        
        $file_name = $form_data['name'];
        $file_size = $form_data['size'];
        $file_tmp =  $form_data['tmp_name'];
        $target_dir = "uploads/${file_name}";

        // Get file ext
        $file_ext=explode('.',$file_name);
        $file_ext=strtolower(end($file_ext));

        // validate file ext
        if(in_array($file_ext, $allowed_ext)){

            if($file_size <= 1000000){
                move_uploaded_file($file_tmp, $target_dir);
                $message='<p style="color:green;">File Uploaded Successfully.</p>';
            }else{
                $message='<p style="color:red;">File too large.</p>';
            }
          
        }  
        else{
            $message='<p style="color:red;">Invalid file type.</p>';
        }

    }else{
        $message='<p style="color:red;">please upload file.</p>';
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php echo $message ?? null; ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" 
method="POST" enctype="multipart/form-data">
<h1>Select Image to Upload:</h1>
<input type="file" name="uploads" >
<input type="submit" value="submit" name="submit">  
</body>
</html>