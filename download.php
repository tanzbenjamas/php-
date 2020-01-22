<?php
session_start();
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


require_once 'connect_db.php';


if(!empty($_GET['file'])){
  if(!empty($_SESSION['login']) && $_SESSION['login'] == true){
    $fileName = basename($_GET['file']);
    $fileid = $_GET['fileid'];
    $userid = $_SESSION['id'];
    $filePath = 'upload_file/'.$fileName;
    if(!empty($fileName) && file_exists($filePath)){
        // Define headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        // Read the file
        readfile($filePath);
        $sql = "INSERT INTO download_count(file_id, filename , user_id , count) VALUES ('$fileid','$fileName','$userid','1') ";

        if ($conn->query($sql) === TRUE) {}
        exit;
    }else{
        echo 'The file does not exist.';
    }
  }else{
    $message = "กรุณาเข้าสู่ระบบ";
      echo ("<script type='text/javascript'>window.alert('$message');window.location.href='logindownload.php';</script>");
  }
}

?>
<!doctype html>
<html lang="en">
    <head>
    <?php require_once 'includes/head.php'; ?>
    </head>
    <body>
    <?php
    @session_start();
?>

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="home.php">Home</a>
    <?php
        if(isset($_SESSION['login'])){
            if(!empty($_SESSION['login']) && $_SESSION['login'] == true){    
    ?>
        <a style="color:#fff" class="navbar-brand col-sm-3 col-md-2 mr-0"><?php echo $_SESSION['email'] ?></a>
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="logoutdownload.php">Sign out</a>
    <?php }else{ ?>
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="logindownload.php">Sign in</a>
    <?php } }else{ ?>
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="logindownload.php">Sign in</a>
    <?php } ?>
</nav>
<br>
   
        <div class="show-list">
            <div class="row">
             
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <h1 style="margin-top: 10px">Download Page</h1>
           
                      <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                              <tr>     
                                <th style="width: 300px">File name</th>
                                <th>Size</th>
                                <th>File</th>
                                <th>Download </th>
                             
                              
                              </tr>
                            </thead>
                            <?php
                                require_once 'connect_db.php';
                                $sql = "SELECT crud_video.id,
                                crud_video.filename AS filename,
                                crud_video.sizefile AS sizefile,
                                count(download_count.count) AS count ,
                                crud_video.id As id
                                FROM crud_video
                                LEFT JOIN download_count on crud_video.id = download_count.file_id 
                                GROUP BY crud_video.filename";
                                $objQuery = mysqli_query($conn,$sql)or die(mysqli_error());
 
                            ?>
                            <tbody>
                                <?php 
                                if ($objQuery->num_rows > 0 ) {   
                                 while($row = mysqli_fetch_array($objQuery) ){
                                    
                                 ?>
                                 <tr>
                                 <td> <?php echo $row['filename']; ?> </td>
                                 <td>
                                    <?php
                                    $size = round($row['sizefile'] / 1048576, 2) . " MB";
                                    echo  $size ;
                                    ?>
                                    </td>
                                 
                                    <td>

                                    <a href="upload_file/<?php echo $row['filename']; ?> ">Viwe</a>
                                    <!-- <video width="300px" height="200px" controls>
                                    <source src="upload_file/<?php //echo $row['filename']; ?> ">
                                   
                                    </video>  -->
                                    </td>

                                    <td>
                                      <a name="download" class="confirmation" href="download.php?fileid=<?php echo $row['id']; ?>&file=<?php echo $row['filename']; ?>">
                                      <span class="iconset" data-feather="download"></span>
                                      </a>[<?php echo $row['count']; ?>]

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
                return confirm('Are you sure you want do download file?');
            });
        </script>
    </body>
</html>
