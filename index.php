<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <?php include("Layout/CssReference.php"); ?> 
    <?php include("Layout/JsReference.php"); ?> 
</head>
<body>
    <!-- <div class="wrapper"> -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="page-header clearfix">
                        <a class="pull-left" href="index.php">
                            <img height="100" width="250" src="http://andersongroup.ph/wp-content/uploads/2016/04/horizontal-2-300x114.png" alt="Anderson Group BPO, Inc.">
                        </a>
                        <h1 class="text-center">Performance Coaching Form
                            <a href="public/create.php" class="btn btn-success pull-right">
                            Add Record</a></h1>
                    </div>
                    <?php
                    // Include config file
                    require_once 'config/config.php';
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM employees";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                         echo "<th>Campaign</th>";
                                        echo "<th>Coaching Topic</th>";
                                        echo "<th>Agent Name</th>";
                                        echo "<th>Area of Success</th>";
                                        echo "<th>Area of Opportunity</th>";
                                        echo "<th>Action Plans</th>";
                                        echo "<th>Coaching Date</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['RecordId'] . "</td>";
                                        echo "<td>" . $row['Campaign'] . "</td>";
                                        echo "<td>" . $row['CoachingTopic'] . "</td>";
                                        echo "<td>" . $row['AgentName'] . "</td>";
                                        echo "<td>" . $row['AreaOfSuccess'] . "</td>";
                                        echo "<td>" . $row['AreaOfOpportunity'] . "</td>";
                                        echo "<td>" . $row['ActionPlans'] . "</td>";
                                        echo "<td>" . $row['CoachingFollowUpDate'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='public/read.php?id=". $row['RecordId'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='public/update.php?id=". $row['RecordId'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='public/delete.php?id=". $row['RecordId'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    unset($pdo);
                    ?>

                    <div class="container">
                          <ul class="pager">
                            <li><a href="#">Previous</a></li>
                            <li><a href="#">Next</a></li>
                          </ul>
                        </div>
                </div>
            </div>        
        </div>
    <!-- </div> -->
</body>
</html>