<?php
// @codingStandardsIgnoreFile

use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;

$findRoot = function ($root) {
	do {
		$lastRoot = $root;
		$root = dirname($root);
		if (is_dir($root . '/vendor/cakephp/cakephp')) {
			return $root;
		}
	} while ($root !== $lastRoot);
	throw new Exception('Cannot find the root of the application, unable to run tests');
};
$root = $findRoot(__FILE__);
unset($findRoot);
chdir($root);

require_once 'vendor/cakephp/cakephp/src/basics.php';
require_once 'vendor/autoload.php';

define('ROOT', $root . DS . 'tests' . DS . 'test_app' . DS);
define('APP', ROOT . 'App' . DS);
define('TMP', sys_get_temp_dir() . DS);
define('CACHE', TMP . DS . 'cache');

Configure::write('debug', true);
Configure::write('App', [
	'namespace' => 'App',
	'paths' => [
		'plugins' => [ROOT . 'Plugin' . DS],
		'templates' => [ROOT . 'App' . DS . 'Template' . DS]
	]
]);

$TMP = new \Cake\Filesystem\Folder(TMP);
$TMP->create(TMP . 'cache/models', 0777);
$TMP->create(TMP . 'cache/persistent', 0777);
$TMP->create(TMP . 'cache/views', 0777);

$cache = [
	'default' => [
		'engine' => 'File'
	],
	'_cake_core_' => [
		'className' => 'File',
		'prefix' => 'crud_myapp_cake_core_',
		'path' => CACHE . 'persistent/',
		'serialize' => true,
		'duration' => '+10 seconds'
	],
	'_cake_model_' => [
		'className' => 'File',
		'prefix' => 'crud_my_app_cake_model_',
		'path' => CACHE . 'models/',
		'serialize' => 'File',
		'duration' => '+10 seconds'
	]
];

Cake\Cache\Cache::config($cache);

if (!getenv('db_dsn')) {
	putenv('db_dsn=sqlite:///:memory:');
}
ConnectionManager::config('test', ['url' => getenv('db_dsn')]);

Plugin::load('Bake', [
	'path' => dirname(dirname(__FILE__)) . DS,
]);
