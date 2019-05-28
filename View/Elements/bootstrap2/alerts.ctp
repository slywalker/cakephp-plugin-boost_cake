<?php
// View
echo $this->Flash->render();

// Controller
$this->Flash->set(__('Alert notice message testing...'), array(
    'element' => 'alert',
	'plugin' => 'BoostCake',
));

$this->Flash->set(__('Alert success message testing...'), array(
    'element' => 'alert',
	'plugin' => 'BoostCake',
	'class' => 'alert-success'
));

$this->Flash->set(__('Alert error message testing...'), array(
    'element' => 'alert',
	'plugin' => 'BoostCake',
	'class' => 'alert-error'
));
?>