<?php

require __DIR__ . '/../vendor/autoload.php';

$application = new \Colo\Console\Application();
$application->add(new \Colo\Console\Command\BuildCommand());
$application->add(new \Colo\Console\Command\CleanCommand());
$application->add(new \Colo\Console\Command\InitCommand());
$application->add(new \Colo\Console\Command\PublishCommand());
$application->add(new \Colo\Console\Command\CreateCommand());
$application->run();