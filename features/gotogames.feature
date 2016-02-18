Feature: Go to games
  In order to play games
  As a logged in user
  I need to be able to access the games page

  Scenario: Go to games as a user
    Given
    And I have a file named "foo"
    And I have a file named "bar"
    When I run "ls"
    Then I should get: