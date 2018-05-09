<?php
// Include config file
require_once '../config/config.php';
 
// Define variables and initialize with empty values
$coachtopic = $campaignid = $agentname = $areasuccess = $areaopportunity = $actionplans = $coachdate = "";
$coachtopic_err = $campaign_err = $agentname_err = $areasuccess_err = $areaopportunity_err = $actionplans_err = $coachdate_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    //Validate coach topic
    $input_coachtopic= trim($_POST["coachtopic"]);
    if(empty($input_coachtopic)){
        $coachtopic_err = 'Please answer.';     
    } else{
        $coachtopic = $input_coachtopic;
    }

    // Validate name
    $input_agentname = trim($_POST["agentname"]);
    if(empty($input_agentname)){
        $agentname_err = "Please enter a name.";
    } elseif(!filter_var(trim($_POST["agentname"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $agentname_err = 'Please enter a valid name.';
    } else{
        $agentname = $input_agentname;
    }
    
    // Validate area of success
    $input_areasuccess = trim($_POST["areasuccess"]);
    if(empty($input_areasuccess)){
        $areasuccess_err = "Required field.";     
    } else{
        $areasuccess = $input_areasuccess;
    }
    
    // Validate area of opportunity
    $input_areaopportunity = trim($_POST["areaopportunity"]);
    if(empty($input_areaopportunity)){
        $areaopportunity_err = "Required field.";     
    }  else{
        $areaopportunity = $input_areaopportunity;
    }

    // Validate action plan
    $input_actionplans = trim($_POST["actionplans"]);
    if(empty($input_actionplans)){
        $actionplans_err = "Required field.";     
    }  else{
        $actionplans = $input_actionplans;
    }

    //Validate campaign
    // if(isset($_REQUEST['campaign']) && $_REQUEST['campaign'] == '') { 
        $input_campaign= trim($_POST["actionplans"]);
            if (empty($input_campaign)){
            $campaign_err = 'Select campaign.'; 
        }else if(isset($_POST['campaign'])){
            $campaign = $_POST['campaign'];  // Storing Selected Value In Variable
        }else{
            $campaign = $input_campaign;
        }


    // Convert the string input of date
    $new_date = date('Y-m-d',strtotime($_POST['coachdate']));
    
    
    // Check input errors before inserting in database
    if(empty($coachtopic_err) && empty($campaign_err) && empty($agentname_err) && empty($areasuccess_err) && empty($areaopportunity_err) && empty($actionplans_err)){
        // Prepare an insert statement
        $sql = "UPDATE coachingrecord 
            LEFT JOIN campaign ON coachingrecord.CampaignId=campaign.CampaignId 
            SET coachingrecord.CampaignId=:campaignid, coachingrecord.CoachingTopic=:coachtopic, coachingrecord.AgentName=:agentname, coachingrecord.AreaOfSuccess=:areasuccess, coachingrecord.AreaOfOpportunity=:areaopportunity, coachingrecord.ActionPlans=:actionplans, coachingrecord.FollowUpDate=:coachdate WHERE coachingrecord.CoachingRecordId=:id";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':campaignid', $param_campaign);
            $stmt->bindParam(':coachtopic', $param_coachtopic);
            $stmt->bindParam(':agentname', $param_agentname);
            $stmt->bindParam(':areasuccess', $param_areasuccess);
            $stmt->bindParam(':areaopportunity', $param_areaopportunity);
            $stmt->bindParam(':actionplans', $param_actionplans);
            $stmt->bindParam(':coachdate', $param_coachdate);
            $stmt->bindParam(':id', $param_id);

            // Set parameters
            $param_campaign = $campaignid;
            $param_coachtopic = $coachtopic;
            $param_agentname = $agentname;
            $param_areasuccess = $areasuccess;
            $param_areaopportunity = $areaopportunity;
            $param_actionplans = $actionplans;
            $param_coachdate = $new_date;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: ../public/dashboard.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);

} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM coachingrecord WHERE CoachingRecordId = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':id', $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $campaign = $row["CampaignId"];
                    $coachtopic = $row['CoachingTopic'];
                    $agentname = $row['AgentName'];
                    $areasuccess = $row["AreaOfSuccess"];
                    $areaopportunity = $row["AreaOfOpportunity"];
                    $actionplans = $row["ActionPlans"];
                    $coachdate = $row["FollowUpDate"];

                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: ../public/error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: ../public/error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <label>Campaign:</label>
                        <div class="form-group <?php echo (!empty($campaign_err)) ? 'has-error' : ''; ?>">
                                <select name="campaignid" class="form-control">
                                    <!-- <option></option>
                                    <option>Flexr/PayPlus/Choice</option>
                                    <option>Horizon Outsourcing</option>
                                    <option>Flexible Outsourcing</option> -->
                                     <?php 
                                        require ("../config/config.php");
                                            $sql = "SELECT CampaignId, Name FROM campaign 
                                            LEFT JOIN coachingrecord ON campaign.CampaignId=coachingrecord.CoachingRecordId";
                                                $data = $pdo->prepare($sql);
                                                $data->execute();
                                                while($row=$data->fetch(PDO::FETCH_ASSOC)){
                                                    $selected = ''; // storage of selected combobox data
                                                    if(!empty($_POST['campaignid']) and $_POST['campaignid'] == $row['CampaignId']) {
                                                          $selected = ' selected="selected"';  // to retain the selected data
                                                       }
                                                    echo '<option value="'.$row['CampaignId'].'"'.$selected.'>'.$row['Name'].'
                                                    </option>'; // extract the data
                                                }
                                                //Close Statement
                                                unset($sql);
                                            //Close connection 
                                            unset($pdo);
                                         ?>
                                </select>
                            <span class="help-block"><?php echo $campaign_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($coachtopic_err)) ? 'has-error' : ''; ?>">
                            <label>Coaching Topic</label><br>
                            <sub>Is this coaching for metrics, attendance, general feedback, etc.</sub>
                            <input type="text" name="coachtopic" class="form-control" value="<?php echo $coachtopic; ?>">
                            <span class="help-block"><?php echo $coachtopic_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($agentname_err)) ? 'has-error' : ''; ?>">
                            <label>Agent Name</label>
                            <input type="text" name="agentname" class="form-control" value="<?php echo $agentname; ?>">
                            <span class="help-block"><?php echo $agentname_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($areasuccess_err)) ? 'has-error' : ''; ?>">
                            <label>Area of Success</label>
                            <textarea name="areasuccess" class="form-control"><?php echo $areasuccess; ?></textarea>
                            <span class="help-block"><?php echo $areasuccess_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($areaopportunity_err)) ? 'has-error' : ''; ?>">
                            <label>Area of Opportunity</label>
                            <textarea name="areaopportunity" class="form-control"><?php echo $areaopportunity; ?></textarea>
                            <span class="help-block"><?php echo $areaopportunity_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($actionplans_err)) ? 'has-error' : ''; ?>">
                            <label>SMART Action Plans</label>
                            <textarea name="actionplans" class="form-control" ><?php echo $actionplans; ?></textarea>
                            <span class="help-block"><?php echo $actionplans_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($coachdate_err)) ? 'has-error' : ''; ?>"> <!-- Date input -->
                            <label class="control-label" for="coachdate">Date</label><br>
                            <sub>If follow-up date is not applicable, DO NOT CHOOSE.</sub>
                            <input class="form-control" id="coachdate" name="coachdate" placeholder="YYYY-MM-DD" type="text"/>
                            <script>
                            $(document).ready(function(){
                              var date_input=$('input[name="coachdate"]'); //our date input has the name "coachdate"
                              var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                              var options={
                                format: 'yyyy-mm-dd',
                                container: container,
                                todayHighlight: true,
                                autoclose: true,
                              };
                              date_input.datepicker(options);
                            })
                        </script>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../public/dashboard.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>