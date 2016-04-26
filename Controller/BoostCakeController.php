<?php
App::uses('AppController', 'Controller');

class BoostCakeController extends AppController {

	public $uses = array('BoostCake.BoostCake');

	public $components = array('Session');

	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);

/**
 * Before filter
 *
 * @throws MethodNotAllowedException
 * @return void
 */
	public function beforeFilter() {
		if (Configure::read('debug') < 1) {
			throw new MethodNotAllowedException(__('Debug setting does not allow access to this url.'));
		}
		parent::beforeFilter();
	}

/**
 * Action for plugin documentation home page
 *
 * @return void
 */
	public function index() {
	}

/**
 * Action for Bootstrap 2 example page
 *
 * @return void
 */
	public function bootstrap2() {
		$this->Flash->alert(__('Alert notice message testing...'), 'alert', array(
			'plugin' => 'BoostCake',
		), 'notice');
		$this->Flash->alert(__('Alert success message testing...'), 'alert', array(
			'plugin' => 'BoostCake',
			'params' => ['class' => 'alert-success']
		), 'success');
		$this->Flash->alert(__('Alert error message testing...'), 'alert', array(
			'plugin' => 'BoostCake',
			'class' => 'alert-error'
		), 'error');
	}

/**
 * Action for Bootstrap 3 example page
 *
 * @return void
 */
	public function bootstrap3() {
		$this->Flash->alert(__('Alert success message testing...'), 'alert', array(
			'plugin' => 'BoostCake',
			'params' => ['class' => 'alert-success']
		), 'success');
		$this->Flash->alert(__('Alert info message testing...'), 'alert', array(
			'plugin' => 'BoostCake',
			'class' => 'alert-info'
		), 'info');
		$this->Flash->alert(__('Alert warning message testing...'), 'alert', array(
			'plugin' => 'BoostCake',
			'params' => ['class' => 'alert-danger'],
		), 'warning');
		$this->Flash->alert(__('Alert danger message testing...'), 'alert', array(
			'plugin' => 'BoostCake',
			'class' => 'alert-danger'
		), 'danger');
	}

}
