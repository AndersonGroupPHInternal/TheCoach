<?php
    require_once '/config/config.php';
    $IsUpdated = False;
    $winner = 'a';
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['SecretCode'] == "AndersonGroupTheCoach")
    {
        try
        {
            echo "Updates:";
            //Table Creation. TODO: Include updating of table.
            //campaign
            $sql = "SELECT 1 FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'thecoach' AND Table_Name = 'campaign'";
            if($result = $pdo->query($sql))
            {
                if($result->rowCount() == 0)
                {
                    $sql = "CREATE TABLE campaign (
                                CampaignId INT NOT NULL AUTO_INCREMENT,
                                Name VARCHAR(50) NOT NULL,
                                PRIMARY KEY (CampaignId)
                            );";
                    if($stmt = $pdo->prepare($sql))
                    {
                        if($stmt->execute())
                        {
                            echo '<br> Created campaign Table;';
                        } else
                        {
                            echo '<br> Error on campaign Table;';
                        }
                    }
                }
            }

            //coachingrecord
            $sql = "SELECT 1 FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'thecoach' AND Table_Name = 'coachingrecord'";
            if($result = $pdo->query($sql))
            {
                if($result->rowCount() == 0)
                {
                    $sql = "CREATE TABLE coachingrecord (
                                FollowUpDate date NOT NULL,
                            
                                CoachingRecordId INT NOT NULL AUTO_INCREMENT,
                                CampaignId INT NOT NULL,
                            
                                AgentName VARCHAR(30) NOT NULL, /*Todo: This might turn into another table*/
                                CoachingTopic VARCHAR(55) NOT NULL,
                                ActionPlans VARCHAR(30) NOT NULL,
                                AreaOfOpportunity VARCHAR(30) NOT NULL,
                                AreaOfSuccess VARCHAR(30) NOT NULL,
                                PRIMARY KEY (CoachingRecordId),
                                FOREIGN KEY (CampaignId) REFERENCES Campaign(CampaignId)
                            );";
                    if($stmt = $pdo->prepare($sql))
                    {
                        if($stmt->execute())
                        {
                            echo '<br> Created coachingrecord Table;';
                        } else
                        {
                            echo '<br> Error on coachingrecord Table;';
                        }
                    }
                }
            }
            //Table Creation. TODO: Include updating of table.
            
            //Default Data Creation.
            $sql = "SELECT 1 FROM campaign WHERE Name = 'Flexr/PayPlus/Choice'";
            if($result = $pdo->query($sql))
            {
                if($result->rowCount() == 0)
                {
                    $sql = "INSERT INTO campaign(Name) VALUES ('Flexr/PayPlus/Choice');";
                    if($stmt = $pdo->prepare($sql))
                    {
                        if($stmt->execute())
                        {
                            echo '<br> Inserted Flexr/PayPlus/Choice to campaign;';
                        } else
                        {
                            echo '<br> Error on Inserting Flexr/PayPlus/Choice to campaing;';
                        }
                    }
                }
            }

            $sql = "SELECT 1 FROM campaign WHERE Name = 'Flexible Outsourcing'";
            if($result = $pdo->query($sql))
            {
                if($result->rowCount() == 0)
                {
                    $sql = "INSERT INTO campaign(Name) VALUES ('Flexible Outsourcing');";
                    if($stmt = $pdo->prepare($sql))
                    {
                        if($stmt->execute())
                        {
                            echo '<br> Inserted Flexible Outsourcing to campaign;';
                        } else
                        {
                            echo '<br> Error on Inserting Flexible Outsourcinge to campaign;';
                        }
                    }
                }
            }
            //Default Creation.
            $IsUpdated = True;
        } catch (Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    elseif ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['SecretCode'] != "AndersonGroupTheCoach")
    {
        echo 'Wrong Code';
    }
 ?>
 <html>
 <body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Is Updated = <?php echo $IsUpdated ? 'true' : 'false'; ?>
        <br>
        Secret Code :<input type="text" name="SecretCode" />
        <br>
        <input type="submit" value="Update"/>
    </form>
 </body>
 </html>