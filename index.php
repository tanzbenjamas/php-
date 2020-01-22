<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'connect_db.php';

// delete
if(isset($_GET['delete_id'])){
  $id = $_GET['delete_id'];
  $sql = "DELETE FROM crud_video WHERE id = '$id'";
  if ($conn->query($sql) === TRUE) {
    $message = "ลบข้อมูลสำเร็จ";
    echo ("<script type='text/javascript'>window.alert('$message');window.location.href='index.php';</script>");
      if($_FILES['filename']['tmp_name']){
        if(move_uploaded_file($_FILES['filename']['tmp_name'], $targetfolder)){ }
      }
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
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
                    <h1 style="margin-top: 10px">List File</h1>
                    <?php
                      if(isset($_GET['updated'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>User!<trong> Updated with success.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['deleted'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>User!<trong> Deleted with success.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['inserted'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>User!<trong> Inserted with success.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['error'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>DB Error!<trong> Something went wrong with your action. Try again!
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }
                    ?>
                      <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>File Name</th>
                                <th>Size</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                            <?php
                            require_once 'connect_db.php';
                            $sql = "SELECT * FROM crud_video";
                            $objQuery = mysqli_query($conn,$sql)or die(mysqli_error());
                            ?>
                            <tbody>
                                <?php if ($objQuery->num_rows > 0) {
                                while($row = mysqli_fetch_array($objQuery)){
                                 ?>
                                 <tr>
                                 
                                 <td>  <?php echo $row['id']; ?>  </td> 

                                    <td>
                                      <a>
                                      <?php echo $row['filename']; ?>
                                      </a>
                                    </td>
                                    <td>
                                    <?php

                                      $size = round($row['sizefile'] / 1048576, 2) . " MB";
                                      echo  $size ;
                                    ?>
                                    </td>

                                    <td>
                                    <a class="" href="form.php?check=edit&edit_id=<?php echo $row['id']; ?>">
                                      <span data-feather="edit"></span>
                                         </td>

                                    <td>
                                      <a class="confirmation" href="index.php?delete_id=<?php echo $row['id']; ?>">
                                      <span data-feather="trash"></span>
                                      </a>
                                    </td>
                                 </tr>

                          <?php } } ?>
                            </tbody>
                        </table>

                      </div>

                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>

        <!-- Custom scripts -->
        <script>
            // JQuery confirmation
            $('.confirmation').on('click', function () {
                return confirm('Are you sure you want do delete this user?');
            });
        </script>
    </body>
</html>
