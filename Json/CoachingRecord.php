 <?php
    require_once '../config/config.php';
    /*echo json_encode( $_SERVER['REQUEST_METHOD']);*/
    
    $employees = array();
    $sql = "SELECT * FROM coachingrecord";
    if($result = $pdo->query($sql)){
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $employees[] = array('FollowUpDate' => $row['FollowUpDate']);

                $employees[] = array('CoachingRecordId' => $row['CoachingRecordId']);
                $employees[] = array('CampaignId' => $row['CampaignId']);

                $employees[] = array('AgentName' => $row['AgentName']);
                $employees[] = array('Campaign' => $row['Campaign']);
                $employees[] = array('CoachingTopic' => $row['CoachingTopic']);
                $employees[] = array('ActionPlans' => $row['ActionPlans']);
                $employees[] = array('AreaOfOpportunity' => $row['AreaOfOpportunity']);
                $employees[] = array('AreaOfSuccess' => $row['AreaOfSuccess']);
            }
        } else{
            
        }
    }
    echo json_encode($employees);
 ?>