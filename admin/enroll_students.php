<?php $title = "Enroll Students"; ?>
<?php require 'chk_Session.php'; ?>
<?php require 'profile_data.php'; ?> 
<?php
if( !isset($_GET['e']) ) {
        header("Location: dashboard.php");
        exit;
    }else{
        $eventName = $_GET['e'];
    }
?>
<?php 
if (!in_array($eventName, $event_id)) {
    header("Location: dashboard.php");
        exit;
}
?>

<?php require 'profile_data.php'; ?> 
<!-- Modal -->
<div class="modal fade" id="enroll_bulk_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Bulk Student Enroll</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="form_model_enroll" style="font-size: 120%;">
        <div id="enrollmodel1">
            <img src="assets/img/csv_instruction.jpg" class="img-fluid" alt="instructions">

         <button type="button" class="btn btn-primary" id="bulk_proceed">Proceed</button>

        </div>
        <div id="enrollmodel2" class="hide-div">
            <input type="text" name="series" placeholder="Series of certificate Number" id="certi_series">
            <input type="number" name="range" placeholder="Certificate Number To Start With" id="certinumber">
            <div class="dashed-box">
                <input type="file" name="file" id="bulk_upload">
                <div class="cont">
                <i class="fa fa-cloud-upload" style="    font-size: 400%;
    color: #8E99A5;
    position: relative;"></i>
                    <div class="tit">
                        Drag &amp; Drop
                      </div>
                      <div class="desc">
                        your file to Assets, or 
                      </div>
                      <div class="browse">
                    click here to browse
                  </div>
              </div>
                
            </div>
                      
        </div>
        <div id="enrollmodel3" class="hide-div">
            <form id='bulk_form'>
            <table id="data_table"class="table"></table>
        </form>
        <input type="text" name="event" disabled value="<?php echo $event; ?>">
             <button type="button" class="btn btn-primary" id="reupload_bulk">Reupload</button>

             <button type="button" class="btn btn-succes" id="final_bulk">Confirm & Add Particepents</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<?php require 'header.php'; ?> 
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Enroll Stdents</h4>
                                <p class="category">Add New Student</p>
                            </div>
                            <div class="content all-icons">

                        		<div class="icon-section">
                        			<h3>Basic Information Of Participent</h3>

                                          <div class="card">
                           
                            <div class="content">
                                <form id="single_enroll_form">                                 <div class="row">
                                    <input type="text" class="form-control border-input" value="<?php echo $eventName;?>" name="event" disabled>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Certificate Number</label>
                                                <input type="text" class="form-control border-input"placeholder="Certificate Number" name="certino">
                                            </div>
                                        </div>
                                          </div>
                                          <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name of Student</label>
                                                <input type="text" class="form-control border-input" placeholder="Name of Student" name="name">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Enrollment Number</label>
                                                <input type="text" class="form-control border-input" placeholder="Enrollment Number" name="enrollment">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Position</label>
                                                <input type="text" class="form-control border-input" placeholder="Position" name="position">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="button" class="btn btn-info btn-fill btn-wd" id="add_single_data">Add Student</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                         <button type="button" class="btn btn-warning btn-fill btn-wd" data-toggle="modal" data-target="#enroll_bulk_model">Add Bulk Students</button>
                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>

                <script type="text/javascript" src="assets/js/papaparse.js"></script>
<?php require 'footer.php'; ?> 
