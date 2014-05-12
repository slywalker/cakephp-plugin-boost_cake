<?php
/**
 * Created by PhpStorm.
 * User: walther
 * Date: 2014/05/12
 * Time: 1:33 PM
 */

namespace BoostCake\View\Widget;

use Cake\View\Widget\WidgetInterface;

class Radio extends \Cake\View\Widget\Radio implements WidgetInterface {

/**
 * Renders a label element for a given radio button.
 *
 * In the future this might be refactored into a separate widget as other
 * input types (multi-checkboxes) will also need labels generated.
 *
 * @param array              $radio  The input properties.
 * @param false|string|array $label  The properties for a label.
 * @param string             $input  The input widget.
 * @param bool               $escape Whether or not to HTML escape the label.
 *
 * @return string Generated label.
 */
	protected function _renderLabel($radio, $label, $input, $escape) {
		$normalLabel = $this->_templates->get('label');
		$this->_templates->remove('label');
		$this->_templates->add('label', $this->_templates->get('radioLabel'));

		$label = parent::_renderLabel($radio, $label, $input, $escape);

		$this->_templates->remove('label');
		$this->_templates->add('label', $normalLabel);
		return $label;
	}
} 