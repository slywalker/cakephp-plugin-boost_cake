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
		'radioWrapper' => '<div class="radio">{{label}}</div>'
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
 * @param null   $text Label text
 * @param array  $options Options
 *
 * @return string
 */
	public function label($fieldName, $text = null, array $options = []) {
		$options = $this->addClass($options, 'control-label');

		if ($this->_formStyle == 'horizontal' && !isset($options['ignoreStyle'])) {
			$options = $this->addClass($options, 'col-sm-' . $this->_labelWidth);
		}
		unset($options['ignoreStyle']);

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
