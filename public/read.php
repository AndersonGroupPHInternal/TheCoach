<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once '../config/config.php';
    
    // Prepare a select statement
    $sql = "SELECT * FROM coachingrecord INNER JOIN campaign ON coachingrecord.CampaignId=campaign.CampaignId WHERE CoachingRecordId = :id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(':id', $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $campaign = $row["Name"];
                $coachtopic = $row['CoachingTopic'];
                $agentname = $row['AgentName'];
                $areasuccess = $row["AreaOfSuccess"];
                $areaopportunity = $row["AreaOfOpportunity"];
                $actionplans = $row["ActionPlans"];
                $coachdate = $row["FollowUpDate"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
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
        } else{
            // URL doesn't contain id parameter. Redirect to error page
            header("location: ../public/error.php");
            exit();
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Campaign</label>
                        <p class="form-control-static"><?php echo $row["Name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Coaching Topic</label>
                        <p class="form-control-static"><?php echo $row["CoachingTopic"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Agent Name</label>
                        <p class="form-control-static"><?php echo $row["AgentName"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Area of Success</label>
                        <p class="form-control-static"><?php echo $row["AreaOfSuccess"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Area of Opportunity</label>
                        <p class="form-control-static"><?php echo $row["AreaOfOpportunity"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>SMART Action Plans</label>
                        <p class="form-control-static"><?php echo $row["ActionPlans"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Coaching Date</label>
                        <p class="form-control-static"><?php echo $row["FollowUpDate"]; ?></p>
                    </div>
                    <p><a href="../public/dashboard.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>