@managing_payment_method
Feature: Adding a new Paysera payment method
  In order to allow payment for orders, using the Paysera gateway
  As an Administrator
  I want to add new payment methods to the system

  Background:
    Given the store operates on a channel named "US" in "USD" currency
    And I am logged in as an administrator

  @ui
  Scenario: Adding a new paysera payment method
    Given I want to create a new Paysera payment method
    When I fill in "Code" with "paysera"
    And I fill in "Project id" with "test_id"
    And I fill in "Project password" with "test_psw"
    And I check "Test mode"
    And I add it
    Then I should be notified that it has been successfully created
    And the payment method "Paysera" should appear in the registry