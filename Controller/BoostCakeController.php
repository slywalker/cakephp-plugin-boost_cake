<?php
App::uses('AppController', 'Controller');

class BoostCakeController extends AppController {

	public $uses = array();

	public $components = array('Session');

	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);

	public function beforeFilter() {
		if (Configure::read('debug') < 1) {
			throw new MethodNotAllowedException(__('Debug setting does not allow access to this url.'));
		}
		parent::beforeFilter();
	}

	public function index() {
		$this->Session->setFlash(__('Alert notice message testing...'), 'alert', array(
			'plugin' => 'TwitterBootstrap',
		), 'notice');
		$this->Session->setFlash(__('Alert success message testing...'), 'alert', array(
			'plugin' => 'TwitterBootstrap',
			'class' => 'alert-success'
		), 'success');
		$this->Session->setFlash(__('Alert error message testing...'), 'alert', array(
			'plugin' => 'TwitterBootstrap',
			'class' => 'alert-error'
		), 'error');
	}

}