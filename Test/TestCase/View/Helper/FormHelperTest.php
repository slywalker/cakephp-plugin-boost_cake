<?php
namespace BoostCake\Test\TestCase\View\Helper;

use BoostCake\View\Helper\FormHelper;
use Cake\View\View;
use Cake\TestSuite\TestCase;
use Cake\View\Form\NullContext;

class TestContext extends NullContext {
/**
 * {@inheritDoc}
 */
	public function hasError($field) {
		return true;
	}

/**
 * {@inheritDoc}
 */
	public function error($field) {
		return ['Please fill in the field'];
	}
}

class FormHelperTest extends TestCase {

	public $View, $Form;

	public function setUp() {
		parent::setUp();
		$this->View = new View();
		$this->Form = new FormHelper($this->View);
	}

	public function tearDown() {
		unset($this->View);
		unset($this->Form);
	}

	public function testInput() {
		$result = $this->Form->input('name');
		$this->assertTags($result, array(
			array('div' => array('class' => 'form-group text')),
			'label' => array('for' => 'name', 'class' => 'control-label'),
			'Name',
			'/label',
			array('input' => array('name' => 'name', 'type' => 'text', 'id' => 'name', 'class' => 'form-control')),
			'/div'
		));
	}

	public function testCheckbox() {
		$result = $this->Form->input('name', array('type' => 'checkbox'));
		$this->assertTags($result, array(
			array('div' => array('class' => 'form-group checkbox')),
			array('input' => array('type' => 'hidden', 'name' => 'name', 'value' => '0')),
			array('input' => array('name' => 'name', 'type' => 'checkbox', 'value' => '1', 'id' => 'name')),
			'label' => array('class' => 'control-label', 'for' => 'name'),
			'Name',
			'/label',
			'/div'
		));
	}

	public function testSelectMultipleCheckbox() {
		$result = $this->Form->select('name',
			array(
				1 => 'one',
				2 => 'two',
				3 => 'three'
			),
			array(
				'multiple' => 'checkbox'
			)
		);
		$this->assertTags($result, array(
			array('input' => array('type' => 'hidden', 'name' => 'name', 'value' => '')),
			array('div' => array('class' => 'checkbox')),
			array('input' => array('type' => 'checkbox', 'name' => 'name[]', 'value' => '1', 'id' => 'name-1')),
			array('label' => array('for' => 'name-1')),
			'one',
			'/label',
			'/div',
			array('div' => array('class' => 'checkbox')),
			array('input' => array('type' => 'checkbox', 'name' => 'name[]', 'value' => '2', 'id' => 'name-2')),
			array('label' => array('for' => 'name-2')),
			'two',
			'/label',
			'/div',
			array('div' => array('class' => 'checkbox')),
			array('input' => array('type' => 'checkbox', 'name' => 'name[]', 'value' => '3', 'id' => 'name-3')),
			array('label' => array('for' => 'name-3')),
			'three',
			'/label',
			'/div',
		));
	}

	public function testRadio() {
		$result = $this->Form->input('name', array(
			'type' => 'radio',
			'options' => array(
				'one' => 'This is one',
				'two' => 'This is two'
			)
		));
		$this->assertTags($result, array(
			array('div' => array('class' => 'form-group radio')),
			array('input' => array('type' => 'hidden', 'name' => 'name', 'value' => '')),
			array('div' => array('class' => 'radio')),
			array('label' => array('for' => 'name-one')),
			array('input' => array('name' => 'name', 'type' => 'radio', 'value' => 'one', 'id' => 'name-one')),
			'This is one',
			'/label',
			'/div',
			array('div' => array('class' => 'radio')),
			array('label' => array('for' => 'name-two')),
			array('input' => array('name' => 'name', 'type' => 'radio', 'value' => 'two', 'id' => 'name-two')),
			'This is two',
			'/label',
			'/div',
			'/div'
		));
	}

	public function testErrorMessage() {
		$context = new TestContext(new \Cake\Network\Request(), []);

		$this->Form->addContextProvider('testContext', function($request, $data) {
			if ($data['entity'] instanceof TestContext) {
				return $data['entity'];
			}
		});
		$this->Form->create($context);
		$result = $this->Form->input('Contact.password');
		$this->assertTags($result, array(
			array('div' => array('class' => 'form-group password has-error')),
			'label' => array('for' => 'contact-password', 'class' => 'control-label'),
			'Password',
			'/label',
			'input' => array(
				'type' => 'password', 'name' => 'Contact[password]',
				'id' => 'contact-password', 'class' => 'form-control form-error'
			),
			array('span' => array('class' => 'help-block text-danger')),
			'Please fill in the field',
			'/span',
			'/div'
		));
	}
}
