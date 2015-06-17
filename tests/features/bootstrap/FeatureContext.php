<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

require_once 'WebServerContext.php';

/**
 * Features context.
 */
class FeatureContext extends WebServerContext
{
    private $url;

    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
        $this->url = $parameters['url'];
    }

    /**
     * @Given /^I call "([^"]*)"$/
     */
    public function iCall($arg1)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $raw_data = curl_exec($ch);
        curl_close($ch);

        $this->response = $raw_data;
    }

    /**
     * @Then /^I get a response$/
     */
    public function iGetAResponse()
    {
        if (empty($this->response)) {
            throw new Exception('Did not get a response from the endpoint');
        }
    }

    /**
     * @Given /^the response is JSON$/
     */
    public function theResponseIsJson()
    {
        if (!$this->isJson($this->response)) {
            throw new Exception('The response wasn\'t JSON');
        }
        $this->json = json_decode($this->response);
    }

    /**
     * @Given /^the response contains at least one call$/
     */
    public function theResponseContainsAtLeastOneCall()
    {
        if(!property_exists($this->json, 'callCharges')
            || !property_exists($this->json->callCharges, 'calls')
            ||  count($this->json->callCharges->calls) == 0) {
            throw new Exception('The response didn\'t contain any calls');
        }
    }

    /**
     * @Given /^the first call contains a cost$/
     */
    public function theFirstCallContainsACost()
    {
        if(!property_exists($this->json->callCharges->calls[0], 'cost')) {
            throw new Exception('The first call didn\'t contain a cost');
        }
    }

    /**
     * @Given /^the first call contains a duration$/
     */
    public function theFirstCallContainsADuration()
    {
        if(!property_exists($this->json->callCharges->calls[0], 'duration')) {
            throw new Exception('The first call didn\'t contain a duration');
        }
    }

    /**
     * @Given /^the reponse contains a total$/
     */
    public function theReponseContainsATotal()
    {
        if(!property_exists($this->json, 'total')) {
            throw new Exception('The bill didn\'t contain a total');
        }
    }

    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }


}
