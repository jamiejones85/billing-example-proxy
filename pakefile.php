<?php

pake_desc('Run the application with local php server');
pake_task('server');

pake_desc('Check the code for psr2 standards');
pake_task('sniff');


pake_desc('Run syntax and unit tests');
pake_task('test');
pake_alias('default', 'test', 'server');

function run_server()
{
    $host = 'localhost:8008';
    pake_echo_comment('Now serving site from http://' . $host);
    pake_sh('php -S ' . $host . ' src/server.php', true);
}

function run_test()
{
    pake_echo_comment('Running unit suite');
    pake_sh('./vendor/bin/phpunit', true);
}

function run_sniff()
{
    pake_echo_comment('Checking files for PSR2');
    pake_sh("./vendor/bin/phpcs -p --standard=PSR2 ./src/app.php ./src/server.php");
}

?>
