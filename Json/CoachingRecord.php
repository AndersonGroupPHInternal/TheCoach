 <?php
    require_once '../config/config.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $coachingRecords = array();
        // $sql = "SELECT FollowUpDate, CoachingRecordId, CampaignId, Campaign.Name, AgentName, CoachingTopic, ActionPlans, AreaOfOpportunity, AreaOfSuccess, CampaignName FROM coachingrecord INNER JOIN campaign ON coachingrecord.CampaignId = Campaign.CampaignId";
        $sql = "SELECT coachingrecord.*, campaign.Name FROM coachingrecord LEFT JOIN campaign ON coachingrecord.CampaignId=campaign.CampaignId";
        if($result = $pdo->query($sql)){
            if($result->rowCount() > 0){
                while($row = $result->fetch()){

                    $CoachingRecord = new stdClass();
                    $CoachingRecord->FollowUpDate = $row['FollowUpDate'];
                    $CoachingRecord->CoachingRecordId = $row['CoachingRecordId'];
                    $CoachingRecord->CampaignId = $row['CampaignId'];
                    $CoachingRecord->AgentName = $row['AgentName'];
                    $CoachingRecord->Campaign = $row['Name'];
                    $CoachingRecord->CoachingTopic = $row['CoachingTopic'];
                    $CoachingRecord->ActionPlans = $row['ActionPlans'];
                    $CoachingRecord->AreaOfOpportunity = $row['AreaOfOpportunity'];
                    $CoachingRecord->AreaOfSuccess = $row['AreaOfSuccess'];
                    // $CoachingRecord->CampaignName = $row['Campaign.CampaignName'];
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