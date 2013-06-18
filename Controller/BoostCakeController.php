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

	public function beforeFilter() {
		if (Configure::read('debug') < 1) {
			throw new MethodNotAllowedException(__('Debug setting does not allow access to this url.'));
		}
		parent::beforeFilter();
	}

	public function index() {
	}

	public function bootstrap2() {
	}

	public function bootstrap3() {
	}

}