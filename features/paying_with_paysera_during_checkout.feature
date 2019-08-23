@paying_with_paysera_during_checkout
Feature: Paying with Paysera during checkout
  In order to buy products
  As a Customer
  I want to be able to pay with Paysera

  Background:
    Given the store operates on a single channel in "United States"
    And there is a user "john@example.com" identified by "password123"
    And the store has a payment method "Paysera" with a code "paysera" and Paysera payment gateway
    And the store has a product "PHP T-Shirt" priced at "€19.99"
    And the store ships everywhere for free
    And I am logged in as "john@example.com"

  @ui
  Scenario: Successful payment
    Given I added product "PHP T-Shirt" to the cart
    And I have proceeded selecting "Paysera" payment method
    When I confirm my order with Paysera payment
    And I get redirected to Paysera and pay successfully
    Then I should be notified that my payment has been completed
