<?php
require_once 'connect_db.php';
if(isset($_POST['btn_save'])){
 
  // insert
  if($_POST['checkcrud'] == "insert"){
    $targetfolder = "upload_file/";
    $targetfolder = $targetfolder . basename( $_FILES['filename']['name']) ;
    $file_type = $_FILES['filename']['type'];
    $file_name = basename( $_FILES['filename']['name']);
    $size_file = $_FILES["filename"]["size"]; 
    $sql = "INSERT INTO crud_video (filename , sizefile)
    VALUES ('$file_name', '$size_file')";

    if ($conn->query($sql) === TRUE) {
      $message = "บันทึกข้อมูลสำเร็จ";
      echo ("<script type='text/javascript'>window.alert('$message');window.location.href='index.php';</script>");
        if($_FILES['filename']['tmp_name']){
          if(move_uploaded_file($_FILES['filename']['tmp_name'], $targetfolder)){ }
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    
  }

    $conn->close();
    //edit
  }else if($_POST['checkcrud'] == "edit"){
    $id = $_POST['id'];
    $targetfolder = "upload_file/";
    $targetfolder = $targetfolder . basename( $_FILES['filename']['name']) ;
    $file_type = $_FILES['filename']['type']; 
    if($_FILES['filename']['tmp_name']){
      $file_name = basename( $_FILES['filename']['name']);
      $size_file = $_FILES["filename"]["size"]; 
          }else{
      $file_name = $_POST['checkname'];
    }
    $sql = "UPDATE crud_video SET filename='$file_name' , sizefile = '$size_file'   WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
      $message = "อัพเดทข้อมูลสำเร็จ";
      echo ("<script type='text/javascript'>window.alert('$message');window.location.href='index.php';</script>");
        if($_FILES['filename']['tmp_name']){
          if(move_uploaded_file($_FILES['filename']['tmp_name'], $targetfolder)){ }
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }

}

?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Head metas, css, and title -->
        <?php require_once 'includes/head.php'; ?>
    </head>
    <body>
        <!-- Header banner -->
        <?php require_once 'includes/header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar menu -->
                <?php require_once 'includes/sidebar.php'; ?>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                  <h1 style="margin-top: 10px">Upload / Edit file</h1>
                  <br>
                  <!-- <p>Required fields are in (*)</p> -->
                  <?php
                    require_once 'connect_db.php';
                    $id = $_GET['edit_id'];
                    $sql = "SELECT * FROM crud_video WHERE id = '$id'";
                    $objQuery = mysqli_query($conn,$sql) or die(mysqli_error());
                    if ($objQuery->num_rows > 0) {
                        while($row = mysqli_fetch_array($objQuery)){
                  ?>
                  <form  action="" method="post" enctype="multipart/form-data"> 
                    <div class="form-group">
                        <label for="filename"> Edite File *</label>
                        <input type="hidden" name="checkcrud" value="edit">
                        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                        <input type="hidden" name="checkname" value="<?php echo $row['filename'];?>">
                        <p>ไฟล์ปัจจุบัน: <?php echo $row['filename'];?></p>
                        <input  class="form-control" type="file" name="filename" id="filename" placeholder="File Name" >
                    </div>
                    <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Upload">
                  </form>
                <?php } ?>
                <?php }else{ ?>
                  <form  action="" method="post" enctype="multipart/form-data"> 
                    <div class="form-group">
                        <label for="filename">Upload file *</label>
                        <input type="hidden" name="checkcrud" value="insert">
                        <input  class="form-control" type="file" name="filename" id="filename" placeholder="File Name">
                    </div>
                    <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Upload">
                  </form>
                <?php } ?>

                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>
    </body>
</html>
