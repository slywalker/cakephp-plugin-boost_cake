<?php
// View
echo $this->Flash->render();

// Controller
$this->Flash->set(__('Alert success message testing...'), array(
    'element' => 'alert',
	'plugin' => 'BoostCake',
	'class' => 'alert-success'
));

$this->Flash->set(__('Alert info message testing...'), array(
    'element' => 'alert',
	'plugin' => 'BoostCake',
	'class' => 'alert-info'
));

$this->Flash->set(__('Alert warning message testing...'), array(
    'element' => 'alert',
	'plugin' => 'BoostCake',
	'class' => 'alert-warning'
));

$this->Flash->set(__('Alert danger message testing...'), array(
    'element' => 'alert',
	'plugin' => 'BoostCake',
	'class' => 'alert-danger'
));
?>