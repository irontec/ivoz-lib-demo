Feature: Manage administrators
  In order to manage administrators
  As a client admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Unable to remove a admin #1
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/administrators/1"
     Then the response status code should be 403

  Scenario: Remove a administrators
    Given I add Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/administrators/2"
    Then the response status code should be 204