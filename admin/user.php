<?php $title = "User Profile"; ?>
<?php require 'chk_Session.php'; ?>
<?php require 'profile_data.php'; ?> 
<?php require 'header.php'; ?> 
<?php
 if( isset($_FILES['avtar']) ){
   $imagename=$_FILES["avtar"]["name"];
   $imagetype=$_FILES["avtar"]["type"];


 $allowed_file_type = array('image/jpg', 'image/jpeg' , 'image/png');
 $file_size = $_FILES["avtar"]["size"];
    $temp=$_FILES['avtar']['tmp_name'];
    $tmp = explode('.', $imagename);
  $ext = end($tmp);
   $file_error = $_FILES['avtar']['error'];
   $newimgname = 'assets/img/avatars/'.$user_name.".".$ext;

   if (in_array($imagetype, $allowed_file_type)|| $file_size < 500000 || $file_error == 0) {
    copy($temp, $newimgname);

    $avtar_sql = "UPDATE admin
  SET avatar= ? WHERE id=?";
          $avtar_query = mysqli_prepare($mysqli, $avtar_sql);
       mysqli_stmt_bind_param($avtar_query, 'si', $newimgname, $_SESSION['user']);
       mysqli_stmt_execute($avtar_query);
       mysqli_stmt_close($avtar_query);
       $login_sql= "SELECT avatar FROM admin WHERE id='{$_SESSION['user']}'";

       $login_query = mysqli_query($mysqli, $login_sql);

      $login_row = mysqli_fetch_array($login_query);
            $avatar = $login_row['avatar'];
   }

unset($_POST);
}

if( isset($_FILES['cover']) ){
   $covername=$_FILES["cover"]["name"];
   $cover_type=$_FILES["cover"]["type"];


 $allowed_file_type = array('image/jpg', 'image/jpeg' , 'image/png');
 $cover_file_size = $_FILES["cover"]["size"];
    $cover_temp=$_FILES['cover']['tmp_name'];
    $tmp1 = explode('.',$covername);
  $cover_ext = end($tmp1);
   $cover_file_error = $_FILES['cover']['error'];
   $newcover_name = 'assets/img/covers/'.$user_name.".".$cover_ext;

   if (in_array($cover_type, $allowed_file_type)|| $cover_file_size < 500000 || $cover_file_error == 0) {
    copy($cover_temp, $newcover_name);

    $cover_sql = "UPDATE admin
  SET cover= ? WHERE id=?";
        $cover_query = mysqli_prepare($mysqli, $cover_sql);
       mysqli_stmt_bind_param($cover_query, 'si', $newcover_name, $_SESSION['user']);
       mysqli_stmt_execute($cover_query);
       mysqli_stmt_close($cover_query);
       $cover2_sql= "SELECT cover FROM admin WHERE id='{$_SESSION['user']}'";

       $cover2_query = mysqli_query($mysqli, $cover2_sql);

      $cover2_row = mysqli_fetch_array($cover2_query);
            $cover = $cover2_row['cover'];
        $sucess_cover = "";
   }else

unset($_POST);
}
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="card card-user">
                            <div class="image">
                                <img src="<?php echo $cover; ?>" alt="..."/>
                                <form id="update_cover" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method='POST' enctype="multipart/form-data">
                                <input type="file" name="cover" style="width: 100%;
    opacity: 0;
    cursor: pointer;
    position: absolute;
    height: 100%;
    top: 0;" onchange="this.form.submit()">
</form>
                            </div>
                            <div class="content">
                                <div class="author">
                                    <div style="position: relative;">
                                        <img class="avatar border-white" src="<?php echo $avatar; ?>" alt="..."/>
                                        <form id="update_avatar" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method='POST' enctype="multipart/form-data">
                                <input type="file" name="avtar" style="width: 100%;
    opacity: 0;
    cursor: pointer;
    position: absolute;
    height: 100%;
    top: 0;" onchange="this.form.submit()">
</form>
                                    </div>
                                  
                                  <h4 class="title"><?php echo $full_name; ?><br />
                                     <a href="#"><small>@<?php echo $user_name; ?></small></a>
                                  </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>12<br /><small>Events</small></h5>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
         
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form id="profile_form">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>User Name</label><br>
                                                <p><b><?php echo $user_name; ?></b></p>
                                                <input type="hidden" class="form-control border-input" name="username" placeholder="Username" value="<?php echo $user_name; ?>">
                                            </div>
                                        </div>
                
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" name="email" class="form-control border-input" placeholder="<?php echo $email; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Mobile No.</label>
                                                <input type="number" name="mob"  class="form-control border-input" placeholder="Mobile Number" value="<?php echo $phone; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control border-input" name ="fullname" placeholder="Name" value="<?php echo $full_name; ?>">
                                            </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <input type="text" class="form-control border-input" name="department" placeholder="Department" value="<?php echo $department; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <input type="text" class="form-control border-input" name="designation" placeholder="Designation" value="<?php echo $designation; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-info btn-fill btn-wd" id="update_profile">Update Profile</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
<script>
     document.getElementById("update_profile").addEventListener("click",function(event){
          event.preventDefault();
          console.log("event hit");
          $.ajax({
               type: 'POST',
               url: 'process_requests/profile.php',
               data: $('#profile_form').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
               success: function(data){
                console.log(data);
                  if (data=="all ok") {
                    document.getElementById("single_enroll_form").reset();
                    document.getElementById("profile_form").innerHTML += "<div class='alert alert-success alert-dismissible'><a class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> This alert box could indicate a successful or positive action.</div>";
                  }else{
                    alert("Data Not Submitted. Something Went Wrong");
                  }
               }
});
        });
</script>
<?php require 'footer.php'; ?> 
