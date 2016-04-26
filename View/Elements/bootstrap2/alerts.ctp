<?php
// View
echo $this->Session->flash();

// Controller
$this->Flash->alert(__('Alert notice message testing...'), 'alert', array(
	'plugin' => 'BoostCake',
));

$this->Flash->alert(__('Alert success message testing...'), 'alert', array(
	'plugin' => 'BoostCake',
	'params' => ['class' => 'alert-success']
));

$this->Flash->alert(__('Alert error message testing...'), 'alert', array(
	'plugin' => 'BoostCake',
	'class' => 'alert-error'
));
?>