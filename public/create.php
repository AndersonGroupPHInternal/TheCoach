<?php
// Include config file
require_once '../config/config.php';
 
// Define variables and initialize with empty values
$coachtopic = $campaign = $agentname = $areasuccess = $areaopportunity = $actionplans = $coachdate = "";
if (isset($_POST['campaignid'])){
    $campaignid = $_POST['campaignid'];
}
$campaign_err = $coachtopic_err = $agentname_err = $areasuccess_err = $areaopportunity_err = $actionplans_err = $coachdate_err = "";
 $date = date('Y-m-d');
 $createdDate = date('Y-m-d');


 session_start();
 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $createdBy = $_SESSION['username'];
 }else{
    header("Location: ../public/error.php");
 }


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Validate coach topic
    $input_coachtopic= trim($_POST["coachtopic"]);
    if(empty($input_coachtopic)){
        $coachtopic_err = 'Please answer.';     
    } else{
        $coachtopic = $input_coachtopic;
    }

    //Validate name
    $input_agentname = trim($_POST["agentname"]);
    if(empty($input_agentname)){
        $agentname_err = "Please enter a name.";
    } elseif(!filter_var(trim($_POST["agentname"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $agentname_err = 'Please enter a valid name.';
    } else{
        $agentname = $input_agentname;
    }
    
    // Validate area of success
    $input_areasuccess= trim($_POST["areasuccess"]);
    if(empty($input_areasuccess)){
        $areasuccess_err = 'Required field.';     
    } else{
        $areasuccess = $input_areasuccess;
    }

    // Validate area of opportunity
    $input_areaopportunity= trim($_POST["areaopportunity"]);
    if(empty($input_areaopportunity)){
        $areaopportunity_err = 'Required field.';     
    } else{
        $areaopportunity = $input_areaopportunity;
    }

    // Validate action plans
    $input_actionplans= trim($_POST["actionplans"]);
    if(empty($input_actionplans)){
        $actionplans_err = 'Required field.';     
    } else{
        $actionplans = $input_actionplans;
    }

    //Validate campaign COMBOBOX
    if (isset($_POST['campaignid' != NULL])){
        $campaignid = $_POST['campaignid'];
    }else if(isset($_POST['campaignid'])){
        $campaignid = $_POST['campaignid']; // Storing Selected Value In Variable
    }else{
        $campaign_err = 'Required field';
    }

    // Convert the string input of date
    $new_date = date('Y-m-d',strtotime($_POST['coachdate']));

    
    // Check input errors before inserting in database
    if(empty($coachtopic_err) && empty($campaign_err) && empty($agentname_err) && empty($areasuccess_err) && empty($areaopportunity_err) && empty($actionplans_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO coachingrecord (ActionPlans, AgentName, AreaOfOpportunity, AreaOfSuccess, CampaignId, CoachingTopic, FollowUpDate, CreatedBy, CreatedDate) VALUES ( :actionplans, :agentname, :areaopportunity, :areasuccess,
         (SELECT CampaignId FROM campaign WHERE CampaignId = :campaignid), :coachtopic, :followupdate, :createdBy, :createdDate)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':actionplans', $param_actionplans);
            $stmt->bindParam(':agentname', $param_agentname);
            $stmt->bindParam(':areaopportunity', $param_areaopportunity);
            $stmt->bindParam(':areasuccess', $param_areasuccess);
            $stmt->bindParam(':campaignid', $param_campaignid);
            $stmt->bindParam(':coachtopic', $param_coachtopic);
            $stmt->bindParam(':followupdate', $param_followupdate);
            $stmt->bindParam(':createdDate', $param_createdDate);
            $stmt->bindParam(':createdBy', $param_createdBy);

            // Set parameters
            $param_actionplans = $actionplans;
            $param_agentname = $agentname;
            $param_areaopportunity = $areaopportunity;
            $param_areasuccess = $areasuccess;
            $param_campaignid = $campaignid;
            $param_coachtopic = $coachtopic;
            $param_followupdate = $new_date;
            $param_createdDate = $createdDate;
            $param_createdBy = $createdBy;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
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
}
?>

        

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <link rel="stylesheet" type="text/css" href="../css/designs.css">
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
                        <h2>Create Record</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <label>Campaign:</label>
                        <div class="form-group <?php echo (!empty($campaign_err)) ? 'has-error' : ''; ?>">
                                <select name="campaignid" id="campaignid" class="form-control">
                                  <option selected disabled hidden>Select Campaign</option>
                                    <?php 
                                        require ("../config/config.php");
                                            $sql = "SELECT CampaignId, Name FROM campaign";
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
                            <label>Areas of Success</label>
                            <textarea name="areasuccess" class="form-control"><?php echo $areasuccess; ?></textarea>
                            <span class="help-block"><?php echo $areasuccess_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($areaopportunity_err)) ? 'has-error' : ''; ?>">
                            <label>Areas of Opportunity</label>
                            <textarea name="areaopportunity" class="form-control"><?php echo $areaopportunity; ?></textarea>
                            <span class="help-block"><?php echo $areaopportunity_err;?></span>
                        </div>
                         <div class="form-group <?php echo (!empty($actionplans_err)) ? 'has-error' : ''; ?>">
                            <label>SMART Action Plans</label><br>
                            <sub>Create an action plan that is Specific - Measurable - Attainable - Realistic - Time Bound</sub>
                            <textarea name="actionplans" class="form-control"><?php echo $actionplans; ?></textarea>
                            <span class="help-block"><?php echo $actionplans_err;?></span>
                        </div>
                        <div class="form-group"> <!-- Date input -->
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
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../public/dashboard.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>