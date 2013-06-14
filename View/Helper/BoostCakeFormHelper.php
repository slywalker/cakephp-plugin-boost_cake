<?php
App::uses('FormHelper', 'View/Helper');
App::uses('Set', 'Utility');

class BoostCakeFormHelper extends FormHelper {

	public $helpers = array('Html' => array(
		'className' => 'BoostCake.BoostCakeHtml'
	));

	protected $_divOptions = array();

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
		if (isset($options['div']['div'])) {
			$divOptions += $options['div'];
			unset($options['div']['div']);
		}
		$this->_divOptions = parent::_divOptions($divOptions);

		$default = array('div' => array('class' => null));
		$options = Hash::merge($default, $options);
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
		$html = parent::_getInput($args);

		if ($this->_divOptions) {
			$tag = $this->_divOptions['tag'];
			unset($this->_divOptions['tag']);
			$html = $this->Html->tag($tag, $html, $this->_divOptions);
		}

		return $html;
	}

/**
 * Overwirte FormHemlper::_selectOptions()
 * If $tag is `<input type="checkbox">` then replace `<label>` position
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
