<?php
const DEFAULT_APP = 'Frontend';

// If the app isn't valid, we're going to load the default application who will generate a 404 error
if (!isset($_GET['app']) || !file_exists(__DIR__ . '/../App/' . $_GET['app'])) {
    $_GET['app'] = DEFAULT_APP;
}
// Require the autoloader
require __DIR__ . '/../lib/OCFram/SplClassLoader.php';
// Register all the autoloads
$OCFramLoader = new SplClassLoader('OCFram', __DIR__ . '/../lib');
$OCFramLoader->register();

$appLoader = new SplClassLoader('App', __DIR__ . '/..');
$appLoader->register();

$modelLoader = new SplClassLoader('Model', __DIR__ . '/../lib/vendors');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__ . '/../lib/vendors');
$entityLoader->register();

$formBuilderLoader = new SplClassLoader('FormBuilder', __DIR__ . '/../lib/vendors');
$formBuilderLoader->register();

// Deduct the class name and instanciate it
$appClass = 'App\\' . $_GET['app'] . '\\' . $_GET['app'] . 'Application';
$app = new $appClass;
$app->run();