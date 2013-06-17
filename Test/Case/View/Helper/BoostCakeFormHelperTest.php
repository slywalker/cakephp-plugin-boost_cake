<?php
App::uses('BoostCakeFormHelper', 'BoostCake.View/Helper');
App::uses('View', 'View');

class BoostCakeFormHelperTest extends CakeTestCase {

	public function setUp() {
		parent::setUp();
		$View = new View();
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

	public function testBeforeInputAfterInput() {
		$result = $this->Form->input('name', array(
			'beforeInput' => 'Before Input',
			'afterInput' => 'After Input',
		));
		$this->assertTags($result, array(
			array('div' => array()),
			'label' => array('for' => 'name'),
			'Name',
			'/label',
			array('div' => array('class' => 'input text')),
			'Before Input',
			array('input' => array('name' => 'data[name]', 'type' => 'text', 'id' => 'name')),
			'After Input',
			'/div',
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
				'multiple' => 'checkbox',
				'class' => 'checkbox-inline'
			)
		);
		$this->assertTags($result, array(
			array('input' => array('type' => 'hidden', 'name' => 'data[name]', 'value' => '', 'id' => 'name')),
			array('label' => array('for' => 'Name1', 'class' => 'checkbox-inline')),
			array('input' => array('type' => 'checkbox', 'name' => 'data[name][]', 'value' => '1', 'id' => 'Name1')),
			' one',
			'/label',
			array('label' => array('for' => 'Name2', 'class' => 'checkbox-inline')),
			array('input' => array('type' => 'checkbox', 'name' => 'data[name][]', 'value' => '2', 'id' => 'Name2')),
			' two',
			'/label',
			array('label' => array('for' => 'Name3', 'class' => 'checkbox-inline')),
			array('input' => array('type' => 'checkbox', 'name' => 'data[name][]', 'value' => '3', 'id' => 'Name3')),
			' three',
			'/label'
		));

		$result = $this->Form->select('name',
			array(
				1 => 'bill',
				'Smith' => array(
					2 => 'fred',
					3 => 'fred jr.'
				)
			),
			array(
				'multiple' => 'checkbox',
				'class' => 'checkbox-inline'
			)
		);
		$this->assertTags($result, array(
			array('input' => array('type' => 'hidden', 'name' => 'data[name]', 'value' => '', 'id' => 'name')),
			array('label' => array('for' => 'Name1', 'class' => 'checkbox-inline')),
			array('input' => array('type' => 'checkbox', 'name' => 'data[name][]', 'value' => '1', 'id' => 'Name1')),
			' bill',
			'/label',
			'fieldset' => array(),
			'legend' => array(),
			'Smith',
			'/legend',
			array('label' => array('for' => 'Name2', 'class' => 'checkbox-inline')),
			array('input' => array('type' => 'checkbox', 'name' => 'data[name][]', 'value' => '2', 'id' => 'Name2')),
			' fred',
			'/label',
			array('label' => array('for' => 'Name3', 'class' => 'checkbox-inline')),
			array('input' => array('type' => 'checkbox', 'name' => 'data[name][]', 'value' => '3', 'id' => 'Name3')),
			' fred jr.',
			'/label',
			'/fieldset'
		));
	}

}
