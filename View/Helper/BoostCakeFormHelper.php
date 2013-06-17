<?php
App::uses('FormHelper', 'View/Helper');
App::uses('Set', 'Utility');

class BoostCakeFormHelper extends FormHelper {

	public $helpers = array('Html' => array(
		'className' => 'BoostCake.BoostCakeHtml'
	));

/**
 * Persistent default options used by input(). Set by FormHelper::create().
 *
 * @var array
 */
	protected $_inputDefaults = array(
		'error' => array(
			'attributes' => array(
				'wrap' => 'span',
				'class' => 'help-block'
			)
		)
	);

	protected $_divOptions = array();

	protected $_inputOptions = array();

/**
 * Overwirte FormHemlper::input()
 * Generates a form input element complete with label and wrapper div
 *
 * ### Options
 *
 * See each field type method for more information. Any options that are part of
 * $attributes or $options for the different **type** methods can be included in `$options` for input().i
 * Additionally, any unknown keys that are not in the list below, or part of the selected type's options
 * will be treated as a regular html attribute for the generated input.
 *
 * - `type` - Force the type of widget you want. e.g. `type => 'select'`
 * - `label` - Either a string label, or an array of options for the label. See FormHelper::label().
 * - `div` - Either `false` to disable the div, or an array of options for the div.
 *	See HtmlHelper::div() for more options.
 * - `options` - For widgets that take options e.g. radio, select.
 * - `error` - Control the error message that is produced. Set to `false` to disable any kind of error reporting (field
 *    error and error messages).
 * - `errorMessage` - Boolean to control rendering error messages (field error will still occur).
 * - `empty` - String or boolean to enable empty select box options.
 * - `before` - Content to place before the label + input.
 * - `after` - Content to place after the label + input.
 * - `between` - Content to place between the label + input.
 * - `beforeInput` - Content to place before the input.
 * - `afterInput` - Content to place after the input.
 * - `format` - Format template for element order. Any element that is not in the array, will not be in the output.
 *	- Default input format order: array('before', 'label', 'between', 'input', 'after', 'error')
 *	- Default checkbox format order: array('before', 'input', 'between', 'label', 'after', 'error')
 *	- Hidden input will not be formatted
 *	- Radio buttons cannot have the order of input and label elements controlled with these settings.
 *
 * @param string $fieldName This should be "Modelname.fieldname"
 * @param array $options Each type of input takes different options.
 * @return string Completed form widget.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#creating-form-elements
 */
	public function input($fieldName, $options = array()) {
		$this->_inputOptions = $options + array(
			'beforeInput' => '',
			'afterInput' => '',
			'errorClass' => 'has-error'
		);
		if (isset($options['beforeInput'])) {
			unset($options['beforeInput']);
		}
		if (isset($options['afterInput'])) {
			unset($options['afterInput']);
		}
		if (isset($options['errorClass'])) {
			unset($options['errorClass']);
		}

		return parent::input($fieldName, $options);
	}

/**
 * Overwirte FormHemlper::_divOptions()
 * Generate inner and outer div options
 * Generate div options for input
 *
 * @param array $options
 * @return array
 */
	protected function _divOptions($options) {
		$divOptions = array('type' => $options['type']);
		if (isset($options['div']) && $options['div'] !== false) {
			if (!is_array($options['div'])) {
				$options['div'] = array('class' => $options['div']);
			}
			if (isset($options['div']['div'])) {
				$divOptions += $options['div'];
				unset($options['div']['div']);
			}
		}
		$this->_divOptions = parent::_divOptions($divOptions);

		$default = array('div' => array('class' => null));
		$options = Hash::merge($default, $options);
		if ($this->tagIsInvalid() !== false) {
			$options['div'] = $this->addClass($options['div'], $this->_inputOptions['errorClass']);
		}
		return parent::_divOptions($options);
	}

/**
 * Overwirte FormHemlper::_getInput()
 * Wrap `<div>` input element
 * Generates an input element
 *
 * @param type $args
 * @return type
 */
	protected function _getInput($args) {
		$input = parent::_getInput($args);
		$beforeInput = $this->_inputOptions['beforeInput'];
		$afterInput = $this->_inputOptions['afterInput'];

		$html = $beforeInput . $input . $afterInput;

		if ($this->_divOptions) {
			$tag = $this->_divOptions['tag'];
			unset($this->_divOptions['tag']);
			$html = $this->Html->tag($tag, $html, $this->_divOptions);
		}

		return $html;
	}

/**
 * Overwirte FormHemlper::_selectOptions()
 * If $attributes['style'] is `<input type="checkbox">` then replace `<label>` position
 * Returns an array of formatted OPTION/OPTGROUP elements
 *
 * @param array $elements
 * @param array $parents
 * @param boolean $showParents
 * @param array $attributes
 * @return array
 */
	protected function _selectOptions($elements = array(), $parents = array(), $showParents = null, $attributes = array()) {
		$selectOptions = parent::_selectOptions($elements, $parents, $showParents, $attributes);

		if ($attributes['style'] === 'checkbox') {
			foreach ($selectOptions as $key => $option) {
				$option = preg_replace('/<div.*?>/', '', $option);
				$option = preg_replace('/<\/div>/', '', $option);
				if (preg_match('/>(<label.*?>)/', $option, $match)) {
					$option = $match[1] . preg_replace('/<label.*?>/', ' ', $option);
					if (isset($attributes['class'])) {
						$option = preg_replace('/(<label.*?)(>)/', '$1 class="' . $attributes['class'] . '"$2', $option);
					}
				}
				$selectOptions[$key] = $option;
			}
		}

		return $selectOptions;
	}

}
