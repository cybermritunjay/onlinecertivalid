<?php $title = "Create Event"; ?>
<?php require 'chk_Session.php'; ?>
<?php require 'profile_data.php'; ?> 
<!-- Modal -->
<div class="modal fade" id="event_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Verify Event</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="form_model_event" style="font-size: 120%;">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save_event">Save Event</button>
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
                                <h4 class="title">Create Event</h4>
                                <p class="category">Create a New Event</p>
                            </div>
                            <div class="content all-icons">

                        		<div class="icon-section">
                        			<h3>Basic Information Of Event</h3>
                        <div class="card">
                           
                            <div class="content">
                                <form id="event_form">
                                    <div class="row">
                                        <div id="err" style="color: red; font-size:120%;"></div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Event Name</label>
                                                <input type="text" class="form-control border-input"placeholder="Name of Event" required>
                                            </div>
                                        </div>
                                          </div>
                                          <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Organiser</label>
                                                <input type="email" class="form-control border-input" placeholder="Organiser of Event" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact Person</label>
                                                <input type="number" class="form-control border-input" placeholder="Mobile Number of Contact Person" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date Heald</label>
                                                <input type="date" class="form-control border-input" placeholder="Date of event" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Event Logo</label>
                                                <input type="file" class="form-control border-input" placeholder="Last Name" value="Faker">
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="text-center">
                                        <button type="button" class="btn btn-info btn-fill btn-wd" id="create_event">Create Event</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                   

        

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script>
            document.getElementById('create_event').addEventListener("click", function(event){
                event.preventDefault();
                var form = document.getElementById( 'event_form' ).elements;
                if (form[0].value !="" && form[1].value !="" && form[2].value !="" && form[3].value !="") {
                     document.getElementById('form_model_event').innerHTML = "<b>Event Name: </b><abbr>"+form[0].value+"</abbr> <br><br><b>Event Organiser:</b>"+form[1].value+" <br><br><b>Event Date:</b>"+form[2].value+" <br><br><b>Contact Person:</b>"+form[3].value+" <br><br><b>Event Logo:</b>"+form[4].value+" <br><br>";
                $('#event_model').modal('show');
            }else{
                document.getElementById('err').innerHTML = "Kindly Fill All The Fields"
               }
            });
            document.getElementById('save_event').addEventListener("click", function(event){
                event.preventDefault();
                var form = document.getElementById( 'event_form' ).elements;
                $.ajax({
                    url: 'process_requests/event.php',
                    type: 'post',
                    data: {event_name: form[0].value,
                            event_organiser:form[1].value,
                            event_date:form[2].value,
                            contact_person:form[3].value,
                            logo:form[4].value,
                            user:<?php echo $_SESSION['user']; ?>
                            },
                })
                .done(function(data) {
                    console.log(data);
                    if (data == "all ok") {
                        document.getElementById( 'event_form' ).innerHTML= "<h1>EventCreated Sucessfully!!!</h1>";
                    }else{
                        alert("Something Went Wrong!!!!!!!!!!!!!!!!!!");
                    }
                });
                
            });
            
        </script>
<?php require 'footer.php'; ?> 
