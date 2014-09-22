Feature: Attendee selects talks
  In order to spend time socialising at conferences instead of looking at the schedule
  As a conference attendee
  I want to plan my personal schedule beforehand

  @critical
  Scenario: Successfully selecting 1 talk from the 1 track conference for a single slot
    Given a conference named "SymfonyLive 2014" with 1 track
    And the "Advanced Symfony" talk is scheduled for "10:30-11:30" slot on the conference track 1
    When I choose the "Advanced Symfony" talk for my personal schedule of this conference
    Then my personal schedule for this conference should have 1 talk
    And the chosen talk for "10:30-11:30" slot should be the "Advanced Symfony"

  Scenario: Failing to select 2 talks into the same slot
    Given a conference named "SymfonyLive 2014" with 2 tracks
    And the "Agile for Dummies" talk is scheduled for "09:00-09:45" slot on the conference track 1
    And the "Advanced Symfony" talk is scheduled for "09:00-09:45" slot on the conference track 2
    When I choose the "Agile for Dummies" talk for my personal schedule of this conference
    And I try to choose the "Advanced Symfony" talk for my personal schedule of this conference
    Then my personal schedule for this conference should have 1 talk
    And I should be notified that slot "09:00-09:45" is already taken by another talk
