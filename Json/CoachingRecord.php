 <?php
    require_once '../config/config.php';
    include_once '../Model/CoachingRecord.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $coachingRecords = array();
        $sql = "SELECT * FROM coachingrecord";
        if($result = $pdo->query($sql)){
            if($result->rowCount() > 0){
                while($row = $result->fetch()){
                    
                    $CoachingRecord = new CoachingRecord();
    
                    $CoachingRecord->FollowUpDate = $row['FollowUpDate'];
    
                    $CoachingRecord->CoachingRecordId = $row['CoachingRecordId'];
                    $CoachingRecord->CampaignId = $row['CampaignId'];
    
                    $CoachingRecord->AgentName = $row['AgentName'];
                    $CoachingRecord->Campaign = $row['Campaign'];
                    $CoachingRecord->CoachingTopic = $row['CoachingTopic'];
                    $CoachingRecord->ActionPlans = $row['ActionPlans'];
                    $CoachingRecord->AreaOfOpportunity = $row['AreaOfOpportunity'];
                    $CoachingRecord->AreaOfSuccess = $row['AreaOfSuccess'];
                    array_push($coachingRecords,$CoachingRecord);
                }
            }
            echo json_encode($coachingRecords);
        }
    }
    else {
        echo json_encode("");
    }    
 ?>