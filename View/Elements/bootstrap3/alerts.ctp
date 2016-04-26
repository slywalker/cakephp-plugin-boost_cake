<?php
// View
echo $this->Session->flash();

// Controller
$this->Flash->alert(__('Alert success message testing...'), 'alert', array(
	'plugin' => 'BoostCake',
	'params' => ['class' => 'alert-success']
));

$this->Flash->alert(__('Alert info message testing...'), 'alert', array(
	'plugin' => 'BoostCake',
	'class' => 'alert-info'
));

$this->Flash->alert(__('Alert warning message testing...'), 'alert', array(
	'plugin' => 'BoostCake',
	'params' => ['class' => 'alert-danger'],
));

$this->Flash->alert(__('Alert danger message testing...'), 'alert', array(
	'plugin' => 'BoostCake',
	'class' => 'alert-danger'
));
?>