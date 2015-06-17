# Billing Example Proxy

## Description

This is the proxy server for the billing example application. I used the opportunity to try a new PHP framework,
[Slim](http://www.slimframework.com/), as there is going to be very little code or complexity to this I wanted
to avoid the bloat of a larger, all encompassing framework. I also took a brief look at behat, a BDD framework,
although this was after I'd written the proxy code. I would, if extending the proxy, write the 'feature' test
upfront now that I'm somewhat familiar with the framework.


## Prerequisites

    * PHP >= 5.4.0
    * [Composer](https://getcomposer.org/doc/00-intro.md)


# Download the dependencies

     composer update

# How to run

Make use of the built-in php web server by running the command below in a terminal, not intended for production.

    vendor/bin/pake server

The server is intended to be called by a client application and can be stopped with ctrl + c

# Tests

To run the tests type:

vendor/bin/pake test

The reports will be in reports/index.html and reports/testdox.html

# Code standards

To run phpcs type:

vendor/bin/pake sniff
