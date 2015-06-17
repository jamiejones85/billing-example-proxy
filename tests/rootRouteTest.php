<?php
/**
 * A couple of integration tests for the proxy
 */
class RouteRouteTest extends LocalWebTestCase {

    public function testSuccessfullyGettingTheData()
    {

        //some json
        $expected = "{ 'total': 20.00, 'calls': [ { 'number': '09876543212', 'duration': '00:14:23' } ] }";

        //Mock up curl
        $curl = $this->getMock('\Curl');

        $curl->expects($this->any())
            ->method('get')
            ->will($this->returnValue((object) array(
                'headers' => array('Status-Code' => 200),
                'body'    => $expected
            )));

        $this->app->curl = function ($c) use ($curl) {
            return $curl;
        };

        $this->client->get('/');
        $this->assertEquals(200, $this->client->response->status());
        $this->assertEquals($expected, $this->client->response->body());
    }

    public function testFailureGettingTheData()
    {

        //some json
        $expected = '"Error contacting external server."';

        //Mock up curl
        $curl = $this->getMock('\Curl');

        $curl->expects($this->any())
            ->method('get')
            ->will($this->returnValue((object) array(
                'headers' => array('Status-Code' => 500),
                'body'    => 'Server Error'
            )));

        $this->app->curl = function ($c) use ($curl) {
            return $curl;
        };

        $this->client->get('/');
        $this->assertEquals(502, $this->client->response->status());
        $this->assertEquals($expected, $this->client->response->body());
    }
}
?>
