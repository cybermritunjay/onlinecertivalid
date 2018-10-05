<?php $title = "List Of Events"; ?>
<?php require 'chk_Session.php'; ?>
<?php require 'profile_data.php'; ?> 
<?php require 'header.php'; ?> 
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Event Table</h4>
                                <p class="category">List of all the Events Creatated by You</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>S.no.</th>
                                    	<th>Name</th>
                                    	<th>Date</th>
                                    	<th>Locke Status</th>
                                    	<th>Organiser</th>
                                    </thead>
                                    <tbody>
                                       <?php for($eve=0;$eve<$total_events;$eve++){
                                        echo "<tr>"; 
                                        echo "<td>".($eve+1)."</td>";
                                        echo "<td><a href='enroll_students.php?e=".$event_id[$eve]."'>".$event_name[$eve]."</a></td>";
                                        echo "<td>".$date[$eve]."</td>";
                                        echo "<td>";
                                        if($locked[$eve]=="0"){echo '<i class="fa fa-circle text-info"></>Unlocked'; }else{echo '<i class="fa fa-circle text-danger"></i>Locked'; }
                                        echo "</td>"; 
                                        echo "<td>".$organiser[$eve]."</td>";
                                        echo "</tr>";
                                    } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
<?php require 'footer.php'; ?> 
