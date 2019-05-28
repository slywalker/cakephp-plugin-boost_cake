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
		$this->Flash->set(__('Alert notice message testing...'), [
			'key' => 'notice',
			'element' => 'alert',
			'plugin' => 'BoostCake',
		]);
		$this->Flash->set(__('Alert success message testing...'), [
			'key' => 'success',
			'element' => 'alert',
			'plugin' => 'BoostCake',
			'class' => 'alert-success'
		]);
		$this->Flash->set(__('Alert error message testing...'), [
			'key' => 'error',
			'element' => 'alert',
			'plugin' => 'BoostCake',
			'class' => 'alert-error'
		]);
	}

/**
 * Action for Bootstrap 3 example page
 *
 * @return void
 */
	public function bootstrap3() {
		$this->Flash->set(__('Alert success message testing...'), [
			'key' => 'success',
			'element' => 'alert',
			'plugin' => 'BoostCake',
			'class' => 'alert-success'
		]);
		$this->Flash->set(__('Alert info message testing...'), [
			'key' => 'info',
			'element' => 'alert',
			'plugin' => 'BoostCake',
			'class' => 'alert-info'
		]);
		$this->Flash->set(__('Alert warning message testing...'), [
			'key' => 'warning',
			'element' => 'alert',
			'plugin' => 'BoostCake',
			'class' => 'alert-warning'
		]);
		$this->Flash->set(__('Alert danger message testing...'), [
			'key' => 'danger',
			'element' => 'alert',
			'plugin' => 'BoostCake',
			'class' => 'alert-danger'
		]);
	}

}
