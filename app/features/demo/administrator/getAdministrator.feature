Feature: Retrieve administrators
  In order to manage administrators
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the administrators json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrators"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "username": "admin",
              "email": "testAdmin@irontec.com",
              "id": 1
          },
          {
              "username": "another_admin",
              "email": "admin2@irontec.com",
              "id": 2
          }
      ]
      """

  Scenario: Retrieve certain administrators json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrators/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "username": "admin",
          "pass": "*****",
          "email": "testAdmin@irontec.com",
          "name": "Name",
          "lastname": "Last name",
          "id": 1
      }
      """
