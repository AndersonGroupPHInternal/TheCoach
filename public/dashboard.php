<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <?php include("../Layout/CssReference.php"); ?> 
    <?php include("../Layout/JsReference.php"); ?> 
    <?php include("../Layout/AngularJsReference.php"); ?> 
    <link rel="icon" type="../images/png" href="../images/tabicon.PNG">
</head>

        <?php
            session_start();
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo "Welcome back, " . $_SESSION['username'] . "!";
            } else {
                header("Location: ../public/index.php");
            }
        ?>

<body ng-app="App">
    <!-- <div class="wrapper"> -->
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="page-header clearfix">
                        <a class="pull-left" href="index.php">
                            <img height="100" width="250" src="http://andersongroup.ph/wp-content/uploads/2016/04/horizontal-2-300x114.png" alt="Anderson Group BPO, Inc.">
                        </a>
                        <h1 class="text-center">Performance Coaching Form
                            <a href="../public/logout.php" class="btn btn-warning pull-right">
                            Logout</a>
                            <a href="../public/create.php" class="btn btn-success pull-right">
                            Add Record</a>
                            
                        </h1>
                    </div>
                    <div ng-controller="CoachingRecordController as model" ng-init="model.Initialise()">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    <thead>
                                        <tr class="thead-inverse">
                                            <th class="text-center">Follow Up Date</th>
                                            <th class="text-center">Coaching Record Id</th>
                                            <th class="text-center">Campaign Id</th>
                                            <th class="text-center">Agent Name</th>
                                            <th class="text-center">Campaign</th>
                                            <th class="text-center">Coaching Topic</th>
                                            <th class="text-center">Action Plans</th>
                                            <th class="text-center">Area Of Opportunity</th>
                                            <th class="text-center">Area Of Success</th>
                                            <th class="text-center">Created By</th>
                                            <th class="text-center">Created Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="coachingRecord in model.CoachingRecords" ng-click="$event.originalEvent.dropdown || model.GoToUpdatePage(coachingRecord.CoachingRecordId)">
                                            <td class="text-center"><span ng-bind="coachingRecord.FollowUpDate"></span></td>
                                            <td class="text-center"><span ng-bind="coachingRecord.CoachingRecordId"></span></td>
                                            <td class="text-center"><span ng-bind="coachingRecord.CampaignId"></span></td>
                                            <td class="text-center"><span ng-bind="coachingRecord.AgentName"></span></td>
                                            <td class="text-center"><span ng-bind="coachingRecord.Campaign"></span></td>
                                            <td class="text-center"><span ng-bind="coachingRecord.CoachingTopic"></span></td>
                                            <td class="text-center"><span ng-bind="coachingRecord.ActionPlans"></span></td>
                                            <td class="text-center"><span ng-bind="coachingRecord.AreaOfOpportunity"></span></td>
                                            <td class="text-center"><span ng-bind="coachingRecord.AreaOfSuccess"></span></td>
                                            <td class="text-center"><span ng-bind="coachingRecord.CreatedBy"></span></td>                                             
                                            <td class="text-center"><span ng-bind="coachingRecord.CreatedDate"></span></td>
                                            <td class="text-center" ng-click="$event.originalEvent.dropdown = true">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a ng-href='../public/read.php?id={{coachingRecord.CoachingRecordId}}'
                                                            title='View Record' data-toggle='tooltip'>
                                                                <span class='glyphicon glyphicon-eye-open'></span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href='../public/update.php?id={{coachingRecord.CoachingRecordId}}' title='Update Record' data-toggle='tooltip'>
                                                                <span class='glyphicon glyphicon-pencil'></span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href='../public/delete.php?id={{coachingRecord.CoachingRecordId}}' title='Delete Record' data-toggle='tooltip'>
                                                                <span class='glyphicon glyphicon-trash'></span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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