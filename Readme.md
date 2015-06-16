# Billing Example Proxy

## Description

This is the proxy server for the billing example application. I used the opportunity to try a new PHP framework,
[Slim](http://www.slimframework.com/), as there is going to be very little code or complexity to this I wanted
to avoid the bloat of a larger, all encompassing framework.

## Prerequisites

    * PHP >= 5.4.0
    * [Composer](https://getcomposer.org/doc/00-intro.md)


# Download the dependencies

     composer update

# How to run

Make use of the built-in php web server by running the command below in a terminal, not intended for production.

    php -S localhost:8000 src/server.php

The server is intended to be called by a client application.

 With the server running, run the tests with:

        bin/behat

 # TODO

     * Have the Behat tests start up a server to run the tests against
     * Mock the bill that is set on the container for use during tests
