<?php
App::uses('BoostCakeFormHelper', 'BoostCake.View/Helper');
App::uses('View', 'View');

class BoostCakeFormHelperTest extends CakeTestCase {

	public function setUp() {
		$View = new View(null);
		$this->Form = new BoostCakeFormHelper($View);
	}

	public function tearDown() {
		unset($this->Form);
	}

	public function testInput() {
		$result = $this->Form->input('name');
		$this->assertTags($result, array(
			array('div' => array()),
			'label' => array('for' => 'name'),
			'Name',
			'/label',
			array('div' => array('class' => 'input text')),
			array('input' => array('name' => 'data[name]', 'type' => 'text', 'id' => 'name')),
			'/div',
			'/div'
		));

		$result = $this->Form->input('name', array(
			'div' => array(
				'class' => 'row',
				'div' => 'col col-lg-10'
			),
			'label' => array(
				'class' => 'col col-lg-2 control-label'
			)
		));
		$this->assertTags($result, array(
			array('div' => array('class' => 'row')),
			'label' => array('for' => 'name', 'class' => 'col col-lg-2 control-label'),
			'Name',
			'/label',
			array('div' => array('class' => 'col col-lg-10')),
			array('input' => array('name' => 'data[name]', 'type' => 'text', 'id' => 'name')),
			'/div',
			'/div'
		));

		$result = $this->Form->input('name', array('div' => false));
		$this->assertTags($result, array(
			'label' => array('for' => 'name'),
			'Name',
			'/label',
			array('div' => array('class' => 'input text')),
			array('input' => array('name' => 'data[name]', 'type' => 'text', 'id' => 'name')),
			'/div'
		));

		$result = $this->Form->input('name', array('div' => array('div' => false)));
		$this->assertTags($result, array(
			array('div' => array()),
			'label' => array('for' => 'name'),
			'Name',
			'/label',
			array('input' => array('name' => 'data[name]', 'type' => 'text', 'id' => 'name')),
			'/div'
		));

		$result = $this->Form->input('name', array(
			'div' => array(
				'tag' => false,
				'div' => false
			)
		));
		$this->assertTags($result, array(
			'label' => array('for' => 'name'),
			'Name',
			'/label',
			array('input' => array('name' => 'data[name]', 'type' => 'text', 'id' => 'name'))
		));
	}

}
