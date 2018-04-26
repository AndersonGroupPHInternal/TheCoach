CREATE DATABASE IF NOT EXISTS thecoach;

USE thecoach;

CREATE TABLE campaign (
    CampaignId INT NOT NULL AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    PRIMARY KEY (CampaignId)
);

CREATE TABLE coachingrecord (
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
);