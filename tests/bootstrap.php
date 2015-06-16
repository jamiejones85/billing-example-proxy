<?php
    require_once 'vendor/autoload.php';

    use There4\Slim\Test\WebTestCase;

    class LocalWebTestCase extends WebTestCase {

        public function getSlimInstance() {
          $app = new \Slim\Slim(array(
              'version'        => '0.0.0',
              'debug'          => false,
              'mode'           => 'testing'
          ));

          // Include our core application file
          require 'src/app.php';
          return $app;
        }
    };

?>
