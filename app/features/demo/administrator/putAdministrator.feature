  Feature: Update administrators
  In order to manage administrators
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Unable to update a admin #1
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/administrators/1" with body:
      """
      {
          "username": "admin_updated",
          "pass": "topSecret",
          "email": "admin2_updated@irontec.com",
          "name": "Name_updated",
          "lastname": "Last name updated"
      }
      """
     Then the response status code should be 403

    Scenario: Update a administrators
      Given I add Authorization header
      When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/administrators/2" with body:
      """
      {
          "username": "admin_updated",
          "pass": "topSecret",
          "email": "admin2_updated@irontec.com",
          "name": "Name_updated",
          "lastname": "Last name updated"
      }
      """
      Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "username": "admin_updated",
          "pass": "*****",
          "email": "admin2_updated@irontec.com",
          "name": "Name_updated",
          "lastname": "Last name updated",
          "id": "match:type(number)"
      }
      """
