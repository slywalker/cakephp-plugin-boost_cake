<?php
App::uses('BoostCakeSessionHelper', 'BoostCake.View/Helper');
App::uses('Controller', 'Controller');
App::uses('View', 'View');

class BoostCakeSessionHelperTest extends CakeTestCase {

	public function setUp() {
		parent::setUp();
		$controller = null;
		$this->View = new View($controller);
		$this->Session = new BoostCakeSessionHelper($this->View);
		CakeSession::start();

		if (!CakeSession::started()) {
			CakeSession::start();
		}

		$_SESSION = array(
			'test' => 'info',
			'Message' => array(
				'flash' => array(
					'element' => 'default',
					'params' => array(),
					'message' => 'This is a calling'
				),
				'flash2' => array(
					'element' => 'alert',
					'params' => array(),
					'message' => 'This is a calling'
				),
				'flash3' => array(
					'element' => 'info',
					'params' => array(),
					'message' => 'This is a calling'
				),
				'flash4' => array(
					'element' => 'success',
					'params' => array(),
					'message' => 'This is a calling'
				),
				'flash5' => array(
					'element' => 'error',
					'params' => array(),
					'message' => 'This is a calling'
				),
				'notification' => array(
					'element' => 'session_helper',
					'params' => array('title' => 'Notice!', 'name' => 'Alert!'),
					'message' => 'This is a test of the emergency broadcasting system',
				),
				'classy' => array(
					'element' => 'default',
					'params' => array('class' => 'positive'),
					'message' => 'Recorded'
				),
				'bare' => array(
					'element' => null,
					'message' => 'Bare message',
					'params' => array(),
				),
			),
			'Deeply' => array('nested' => array('key' => 'value')),
		);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		$_SESSION = array();
		unset($this->View, $this->Session);
		CakePlugin::unload();
		parent::tearDown();
	}

	public function testFlash() {
		$result = $this->Session->flash('flash');
		$expected = '<div id="flashMessage" class="message">This is a calling</div>';
		$this->assertEquals($expected, $result);
		$this->assertFalse($this->Session->check('Message.flash'));

		$result = $this->Session->flash('flash2');
		$expected = '<div class="alert">
	<a class="close" data-dismiss="alert" href="#">×</a>
	This is a calling</div>';
		$this->assertEquals($expected, $result);
		$this->assertFalse($this->Session->check('Message.flash2'));

		$result = $this->Session->flash('flash3');
		$expected = '<div class="alert alert-info">
	<a class="close" data-dismiss="alert" href="#">×</a>
	This is a calling</div>';
		$this->assertEquals($expected, $result);
		$this->assertFalse($this->Session->check('Message.flash3'));

		$result = $this->Session->flash('flash4');
		$expected = '<div class="alert alert-success">
	<a class="close" data-dismiss="alert" href="#">×</a>
	This is a calling</div>';
		$this->assertEquals($expected, $result);
		$this->assertFalse($this->Session->check('Message.flash4'));

		$result = $this->Session->flash('flash5');
		$expected = '<div class="alert alert-error">
	<a class="close" data-dismiss="alert" href="#">×</a>
	This is a calling</div>';
		$this->assertEquals($expected, $result);
		$this->assertFalse($this->Session->check('Message.flash5'));

		$expected = '<div id="classyMessage" class="positive">Recorded</div>';
		$result = $this->Session->flash('classy');
		$this->assertEquals($expected, $result);

		App::build(array(
			'View' => array(CAKE . 'Test' . DS . 'test_app' . DS . 'View' . DS)
		));
		$result = $this->Session->flash('notification');
		$result = str_replace("\r\n", "\n", $result);
		$expected = "<div id=\"notificationLayout\">\n\t<h1>Alert!</h1>\n\t<h3>Notice!</h3>\n\t<p>This is a test of the emergency broadcasting system</p>\n</div>";
		$this->assertEquals($expected, $result);
		$this->assertFalse($this->Session->check('Message.notification'));

		$result = $this->Session->flash('bare');
		$expected = 'Bare message';
		$this->assertEquals($expected, $result);
		$this->assertFalse($this->Session->check('Message.bare'));
		$_SESSION = array();
	}

}
