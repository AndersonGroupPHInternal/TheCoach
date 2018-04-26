 <?php
    require_once '../config/config.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $coachingRecords = array();
        $sql = "SELECT FollowUpDate, CoachingRecordId, AgentName, CoachingTopic, ActionPlans, AreaOfOpportunity, AreaOfSuccess, Campaign.Name CampaignName
         FROM coachingrecord JOIN campaign ON coachingrecord.CampaignId = Campaign.CampaignId";
        if($result = $pdo->query($sql)){
            if($result->rowCount() > 0){
                while($row = $result->fetch()){
                    
                    $CoachingRecord = null;
    
                    $CoachingRecord->FollowUpDate = $row['FollowUpDate'];
    
                    $CoachingRecord->CoachingRecordId = $row['CoachingRecordId'];
                    $CoachingRecord->CampaignId = $row['CampaignId'];
    
                    $CoachingRecord->AgentName = $row['AgentName'];
                    $CoachingRecord->CoachingTopic = $row['CoachingTopic'];
                    $CoachingRecord->ActionPlans = $row['ActionPlans'];
                    $CoachingRecord->AreaOfOpportunity = $row['AreaOfOpportunity'];
                    $CoachingRecord->AreaOfSuccess = $row['AreaOfSuccess'];

                    $CoachingRecord->CampaignName = $row['CampaignName'];
                    array_push($coachingRecords,$CoachingRecord);
                }
            }
            echo json_encode($coachingRecords);
        }
    }
    else {
        echo json_encode($_SERVER['REQUEST_METHOD']);
    }    
 ?>