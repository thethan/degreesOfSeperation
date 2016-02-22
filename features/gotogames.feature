Feature: Go to games
  In order to play games
  As a logged in user
  I need to be able to access the games page

  Scenario: Go to games as a user
    Given I am logged in
    When I click on "play"
    Then I should not see an "img" element