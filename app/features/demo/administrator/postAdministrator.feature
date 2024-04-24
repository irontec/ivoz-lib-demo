Feature: Create administrators
  In order to manage administrators
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a administrators
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/administrators" with body:
      """
      {
          "username": "admin3",
          "pass": "topSecret",
          "email": "admin3@irontec.com",
          "name": "Name",
          "lastname": "Last name"
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "username": "admin3",
          "pass": "*****",
          "email": "admin3@irontec.com",
          "name": "Name",
          "lastname": "Last name",
          "id": "match:type(integer)"
      }
      """

  Scenario: Retrieve created administrators
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/administrators/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
        "username": "admin3",
        "pass": "*****",
        "email": "admin3@irontec.com",
        "name": "Name",
        "lastname": "Last name",
        "id": "match:regexp(/[0-9]+/)"
      }
      """
