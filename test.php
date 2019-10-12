<?php

declare(strict_types = 1);

require_once __DIR__.'/vendor/autoload.php';

use Doctrine\DBAL\Logging\EchoSQLLogger;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

define('SQLITE_DB_PATH', __DIR__.'/db.sqlite');

// Clear the DB if it still exists from the last run
if (file_exists(SQLITE_DB_PATH))
    unlink(SQLITE_DB_PATH);

$config = Setup::createAnnotationMetadataConfiguration([__DIR__.'/entities'], $isDevMode = true, $proxyDir = null, $cache = null, $useSimpleAnnotationReader = false);
$config->setSQLLogger(new EchoSQLLogger());

$connection = [
	'driver'    => 'pdo_sqlite',
	'path'      => SQLITE_DB_PATH,
];

$em = EntityManager::create($connection, $config);

// Create schema
$schemaTool = new \Doctrine\ORM\Tools\SchemaTool($em);
$schemaTool->createSchema($em->getMetadataFactory()->getAllMetadata());

// Create and populate entities
$uploadedFile = new UploadedFile();
$user = new User();

$uploadedFile->setOwner($user);
$uploadedFile->setLastDownloadedBy($user);
$user->setLastUploadedFile($uploadedFile);

// Persist and flush
$em->persist($uploadedFile);
$em->persist($user);

$em->flush();

// Clean up
$schemaTool->dropSchema($em->getMetadataFactory()->getAllMetadata());
