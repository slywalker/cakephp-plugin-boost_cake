<?php
namespace BoostCake\View\Helper;

use Cake\View\View;

class FormHelper extends \Cake\View\Helper\FormHelper {

	protected $_divOptions = array();

	protected $_inputOptions = array();

	protected $_inputType = null;

	protected $_fieldName = null;

	protected $_bootstrapTemplates = [
		'error' => '<span class="help-block text-danger">{{content}}</span>',
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
 * Overwrite Cake\View\Helper\FormHelper::input()
 */
	public function input($fieldName, array $options = array()) {
		$options = $this->addClass($options, 'form-control');

		return parent::input($fieldName, $options);
	}

/**
 * Overwrite Cake\View\Helper\FormHelper::label()
 */
	public function label($fieldName, $text = null, array $options = []) {
		$options = $this->addClass($options, 'control-label');

		return parent::label($fieldName, $text, $options);
	}

	public function checkbox($fieldName, array $options = []) {
		if ($options['type'] == 'checkbox') {
			$options['class'] = trim(str_replace('form-control', '', $options['class']));
			if (empty($options['class'])) {
				unset($options['class']);
			}
		}

		return parent::checkbox($fieldName, $options);
	}
}
