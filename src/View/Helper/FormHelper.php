<?php
namespace BoostCake\View\Helper;

use Cake\View\Helper\FormHelper as BaseForm;
use Cake\View\View;

class FormHelper extends BaseForm {

	const COLCOUNT = 12;

	protected $_formStyle = 'normal';
	protected $_labelWidth = 3;
	protected $_fieldWidth = 9;

	protected $_bootstrapTemplates = [
		'error' => '<div class="help-block text-danger">{{content}}</div>',
		'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}</div>',
		'inputContainerError' => '<div class="form-group {{type}}{{required}} has-error">{{content}}{{error}}</div>',
		'submitContainer' => '<div class="submit">{{content}}</div>',
		'radioLabel' => '<label{{attrs}}>{{input}}{{text}}</label>',
		'radioWrapper' => '<div class="radio">{{label}}</div>',
		'checkboxLabel' => '<label{{attrs}}>{{input}}{{text}}</label>',
		'checkboxFormGroup' => '<div class="checkbox">{{label}}</div>',
		'checkboxContainer' => '<div class="form-group {{required}}">{{content}}</div>',
	];

/**
 * Construct the widgets and binds the default context providers
 *
 * @param \Cake\View\View $View   The View this helper is being attached to.
 * @param array           $config Configuration settings for the helper.
 */
	public function __construct(View $View, array $config = []) {
		$this->_defaultConfig['templates'] = array_merge($this->_defaultConfig['templates'], $this->_bootstrapTemplates);
		parent::__construct($View, $config);

		$this->addWidget('radio', ['BoostCake\View\Widget\Radio', 'label']);
	}

/**
 * {{@inheritDoc}}
 *
 * @param string $fieldName Fieldname
 * @param array $options Options
 *
 * @return string
 */
	public function input($fieldName, array $options = []) {
		$options = $this->addClass($options, 'form-control');

		return parent::input($fieldName, $options);
	}

/**
 * {{@inheritDoc}}
 *
 * @param string $fieldName Field
 * @param null $text Label text
 * @param array $options Options
 *
 * @return string
 */
	protected function _inputLabel($fieldName, $label, $options) {
		if (!is_array($label)) {
			$label = [
				'text' => $label,
			];
		}
		$label['type'] = $options['type'];

		$templater = $this->templater();
		$currentLabel = $templater->get('label');
		if ($options['type'] === 'checkbox') {
			$templater->add([
				'label' => $templater->get('checkboxLabel')
			]);
		}

		$output = parent::_inputLabel($fieldName, $label, $options);

		if ($options['type'] === 'checkbox') {
			$output = $this->_hiddenCheckbox($fieldName, $options) . $output;
			$templater->add([
				'label' => $currentLabel
			]);
		}

		return $output;
	}

/**
 * Generates the checkbox hidden field
 *
 * @param string $fieldName Field name
 * @param array $options Option array
 *
 * @return string
 */
	protected function _hiddenCheckbox($fieldName, array $options) {
		$options += ['hiddenField' => true];

		if ($options['hiddenField']) {
			unset($options['value']);
			$options = $this->_initInputField($fieldName, $options);

			$hiddenOptions = [
				'name' => $options['name'],
				'value' => ($options['hiddenField'] !== true ? $options['hiddenField'] : '0'),
				'form' => isset($options['form']) ? $options['form'] : null,
				'secure' => false
			];
			if (isset($options['disabled']) && $options['disabled']) {
				$hiddenOptions['disabled'] = 'disabled';
			}

			return $this->hidden($fieldName, $hiddenOptions);
		}
	}

/**
 * {{@inheritDoc}}
 *
 * @param string $fieldName Field
 * @param null $text Label text
 * @param array $options Options
 *
 * @return string
 */
	public function label($fieldName, $text = null, array $options = []) {
		if (!isset($options['type'])) {
			$options['type'] = '';
		}

		if ($this->_formStyle == 'horizontal' && !isset($options['ignoreStyle']) && $options['type'] !== 'checkbox') {
			$options = $this->addClass($options, 'col-sm-' . $this->_labelWidth);
		}
		if ($options['type'] !== 'checkbox') {
			$options = $this->addClass($options, 'control-label');
		}
		unset($options['ignoreStyle']);
		unset($options['type']);

		return parent::label($fieldName, $text, $options);
	}

/**
 * {{@inheritDoc}}
 *
 * @param string $fieldName Field
 * @param array  $options   Options
 *
 * @return string
 */
	public function checkbox($fieldName, array $options = []) {
		if (isset($options['type']) && !empty($options['class']) && $options['type'] == 'checkbox') {
			$options['class'] = trim(str_replace('form-control', '', $options['class']));
			if (empty($options['class'])) {
				unset($options['class']);
			}
		}
		$options['hiddenField'] = false;

		return parent::checkbox($fieldName, $options);
	}

	protected function _formStyleOptions($options) {
		$formStyle = $options['formStyle'];
		unset($options['formStyle']);

		switch ($formStyle) {
			case 'horizontal':
				if (isset($options['labelWidth'])) {
					$this->_labelWidth = $options['labelWidth'];
					unset($options['labelWidth']);
				}
				$this->_fieldWidth = static::COLCOUNT - $this->_labelWidth;

				$options = $this->addClass($options, 'form-horizontal');
				$this->_formStyle = 'horizontal';
				$this->templates([
					'formGroup' => '{{label}}<div class="col-sm-' . $this->_fieldWidth . '">{{input}}</div>',
					'checkboxFormGroup' => '<div class="col-sm-' . $this->_fieldWidth . ' col-sm-offset-' . $this->_labelWidth . '"><div class="checkbox">{{label}}</div></div>',
					'error' => '<div class="clearfix"></div><div class="help-block text-danger col-sm-' . $this->_fieldWidth . ' col-sm-push-' . $this->_labelWidth . '">{{content}}</div>',
				]);
				break;
		}

		return $options;
	}

/**
 * {{@inheritDoc}}
 *
 * @param null  $model Context
 * @param array $options Options
 *
 * @return string
 */
	public function create($model = null, array $options = []) {
		if (isset($options['formStyle'])) {
			$options = $this->_formStyleOptions($options);
		}

		return parent::create($model, $options);
	}
}
