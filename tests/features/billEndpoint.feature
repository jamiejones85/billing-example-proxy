Feature: billEndpoint
    In order to retrieve a bill
    As a Sky customer
    I need to be able to see my charges

Scenario:
    Given I call "/"
    Then I get a response
    And the response is JSON
    And the response contains at least one call
    And the first call contains a cost
    And the first call contains a duration
    And the reponse contains a total
