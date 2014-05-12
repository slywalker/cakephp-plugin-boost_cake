<?php
namespace BoostCake\View\Helper;

use Cake\View\View;
use Cake\View\Helper\FormHelper;

class BoostCakeFormHelper extends FormHelper {

	public $helpers = array('Html' => array(
		'className' => 'BoostCake.BoostCakeHtml'
	));

	protected $_divOptions = array();

	protected $_inputOptions = array();

	protected $_inputType = null;

	protected $_fieldName = null;

	protected $_bootstrapTemplates = [
		'error' => '<span class="help-block text-danger">{{content}}</span>',
		'groupContainer' => '<div class="form-group {{type}}{{required}}">{{content}}</div>',
		'groupContainerError' => '<div class="form-group {{type}}{{required}} error">{{content}}{{error}}</div>',
		'submitContainer' => '<div class="submit">{{content}}</div>',
		'radioLabel' => '<label{{attrs}}>{{input}}{{text}}</label>',
		'radioContainer' => '{{label}}'
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

/*	public function input($fieldName, array $options = array()) {
		$this->_fieldName = $fieldName;

		$default = array(
			'error' => array(
				'attributes' => array(
					'wrap' => 'span',
					'class' => 'help-block text-danger'
				)
			),
			'wrapInput' => array(
				'tag' => 'div'
			),
			'checkboxDiv' => 'checkbox',
			'beforeInput' => '',
			'afterInput' => '',
			'errorClass' => 'has-error error'
		);

		if (isset($options['label']) && is_string($options['label'])) {
			$options['label'] = array(
				'text' => $options['label']
			);
		}

		$options = Hash::merge(
			$default,
			$this->_inputDefaults,
			$options
		);

		$this->_inputOptions = $options;

		$options['error'] = false;
		if (isset($options['wrapInput'])) {
			unset($options['wrapInput']);
		}
		if (isset($options['checkboxDiv'])) {
			unset($options['checkboxDiv']);
		}
		if (isset($options['beforeInput'])) {
			unset($options['beforeInput']);
		}
		if (isset($options['afterInput'])) {
			unset($options['afterInput']);
		}
		if (isset($options['errorClass'])) {
			unset($options['errorClass']);
		}

		$inputDefaults = $this->_inputDefaults;
		$this->_inputDefaults = array();

		$html = parent::input($fieldName, $options);

		$this->_inputDefaults = $inputDefaults;

		if ($this->_inputType === 'checkbox') {
			if (isset($options['before'])) {
				$html = str_replace($options['before'], '%before%', $html);
			}
			$regex = '/(<label.*?>)(.*?<\/label>)/';
			if (preg_match($regex, $html, $label)) {
				$label = str_replace('$', '\$', $label);
				$html = preg_replace($regex, '', $html);
				$html = preg_replace(
					'/(<input type="checkbox".*?>)/',
					$label[1] . '$1 ' . $label[2],
					$html
				);
			}
			if (isset($options['before'])) {
				$html = str_replace('%before%', $options['before'], $html);
			}
		}

		return $html;
	}*/

/**
 * Overwrite FormHelper::_divOptions()
 * Generate inner and outer div options
 * Generate div options for input
 *
 * @param array $options
 * @return array
 */
/*	protected function _divOptions($options) {
		$this->_inputType = $options['type'];

		$divOptions = array(
			'type' => $options['type'],
			'div' => $this->_inputOptions['wrapInput']
		);
		$this->_divOptions = parent::_divOptions($divOptions);

		$default = array('div' => array('class' => null));
		$options = Hash::merge($default, $options);
		$divOptions = parent::_divOptions($options);
		if ($this->tagIsInvalid() !== false) {
			$divOptions = $this->addClass($divOptions, $this->_inputOptions['errorClass']);
		}
		return $divOptions;
	}*/

/**
 * Overwrite FormHelper::_getInput()
 * Wrap `<div>` input element
 * Generates an input element
 *
 * @param type $args
 * @return type
 */
/*	protected function _getInput($fieldName, $options) {
		$input = parent::_getInput($fieldName, $options);
		if ($this->_inputType === 'checkbox' && $this->_inputOptions['checkboxDiv'] !== false) {
			$input = $this->Html->div($this->_inputOptions['checkboxDiv'], $input);
		}

		$beforeInput = $this->_inputOptions['beforeInput'];
		$afterInput = $this->_inputOptions['afterInput'];

		$error = null;
		$errorOptions = $this->_extractOption('error', $this->_inputOptions, null);
		$errorMessage = $this->_extractOption('errorMessage', $this->_inputOptions, true);
		if ($this->_inputType !== 'hidden' && $errorOptions !== false) {
			$errMsg = $this->error($this->_fieldName, $errorOptions);
			if ($errMsg && $errorMessage) {
				$error = $errMsg;
			}
		}

		$html = $beforeInput . $input . $afterInput . $error;

		if ($this->_divOptions) {
			$tag = $this->_divOptions['tag'];
			unset($this->_divOptions['tag']);
			$html = $this->Html->tag($tag, $html, $this->_divOptions);
		}

		return $html;
	}*/

/**
 * Overwrite FormHelper::_selectOptions()
 * If $attributes['style'] is `<input type="checkbox">` then replace `<label>` position
 * Returns an array of formatted OPTION/OPTGROUP elements
 *
 * @param array $elements
 * @param array $parents
 * @param boolean $showParents
 * @param array $attributes
 * @return array
 */
/*	protected function _selectOptions($elements = array(), $parents = array(), $showParents = null, $attributes = array()) {
		$selectOptions = parent::_selectOptions($elements, $parents, $showParents, $attributes);

		if ($attributes['style'] === 'checkbox') {
			foreach ($selectOptions as $key => $option) {
				$option = preg_replace('/<div.*?>/', '', $option);
				$option = preg_replace('/<\/div>/', '', $option);
				if (preg_match('/>(<label.*?>)/', $option, $match)) {
					$class = $attributes['class'];
					if (preg_match('/.* class="(.*)".* /', $match[1], $classMatch)) {
						$class = $classMatch[1] . ' ' . $attributes['class'];
						$match[1] = str_replace(' class="' . $classMatch[1] . '"', '', $match[1]);
					}
					$option = $match[1] . preg_replace('/<label.*?>/', ' ', $option);
					$option = preg_replace('/(<label.*?)(>)/', '$1 class="' . $class . '"$2', $option);
				}
				$selectOptions[$key] = $option;
			}
		}

		return $selectOptions;
	}*/

/**
 * Creates an HTML link, but access the url using the method you specify (defaults to POST).
 * Requires javascript to be enabled in browser.
 *
 * This method creates a `<form>` element. So do not use this method inside an existing form.
 * Instead you should add a submit button using FormHelper::submit()
 *
 * ### Options:
 *
 * - `data` - Array with key/value to pass in input hidden
 * - `method` - Request method to use. Set to 'delete' to simulate HTTP/1.1 DELETE request. Defaults to 'post'.
 * - `confirm` - Can be used instead of $confirmMessage.
 * - Other options is the same of HtmlHelper::link() method.
 * - The option `onclick` will be replaced.
 * - `block` - For nested form. use View::fetch() output form.
 *
 * @param string $title The content to be wrapped by <a> tags.
 * @param string|array $url Cake-relative URL or array of URL parameters, or external URL (starts with http://)
 * @param array $options Array of HTML attributes.
 * @param bool|string $confirmMessage JavaScript confirmation message.
 * @return string An `<a />` element.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#FormHelper::postLink
 */
/*	public function postLink($title, $url = null, array $options = array(), $confirmMessage = false) {
		$block = false;
		if (!empty($options['block'])) {
			$block = $options['block'];
			unset($options['block']);
		}

		$fields = $this->fields;
		$this->fields = array();

		$out = parent::postLink($title, $url, $options, $confirmMessage);

		$this->fields = $fields;

		if ($block) {
			$regex = '/<form.*?>.*?<\/form>/';
			if (preg_match($regex, $out, $match)) {
				$this->_View->append($block, $match[0]);
				$out = preg_replace($regex, '', $out);
			}
		}

		return $out;
	}*/

}
