
SET
    @CampaingIdFirst = (SELECT MIN(CampaignId) FROM campaign)
    ,@CampaingIdLast = (SELECT MAX(CampaignId) FROM campaign);   

INSERT INTO coachingrecord
    (FollowUpDate, CampaignId, AgentName, Campaign, CoachingTopic, ActionPlans, AreaOfOpportunity, AreaOfSuccess) VALUES
    ('2018-04-10', @CampaingIdFirst, 'Agent1', 'Campaign1', 'CoachingTopic1', 'ActionPlans1', 'AreaOfOpportunity1', 'AreaOfSuccess1'),
    ('2018-04-10', @CampaingIdLast, 'Agent2', 'Campaign2', 'CoachingTopic2', 'ActionPlans2', 'AreaOfOpportunity2', 'AreaOfSuccess2')
