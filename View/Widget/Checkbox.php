<?php
namespace BoostCake\View\Widget;

use Cake\View\Widget\WidgetInterface;

class Checkbox extends \Cake\View\Widget\Checkbox implements WidgetInterface {

	use RadioCheckboxTrait;

/**
 * Render a checkbox element.
 *
 * Data supports the following keys:
 *
 * - `name` - The name of the input.
 * - `value` - The value attribute. Defaults to '1'.
 * - `val` - The current value. If it matches `value` the checkbox will be checked.
 *   You can also use the 'checked' attribute to make the checkbox checked.
 * - `disabled` - Whether or not the checkbox should be disabled.
 *
 * Any other attributes passed in will be treated as HTML attributes.
 *
 * @param array $data The data to create a checkbox with.
 *
 * @return string Generated HTML string.
 */
	public function render(array $data) {
		$data += [
			'name' => '',
			'value' => 1,
			'val' => null,
			'checked' => false,
			'disabled' => false,
			'label' => true,
		];
		if ($this->_isChecked($data)) {
			$data['checked'] = true;
		}
		unset($data['val']);

		$attrs = $this->_templates->formatAttributes(
			$data,
			['name', 'value']
		);

		return $this->_templates->format('checkbox', [
			'name' => $data['name'],
			'value' => $data['value'],
			'attrs' => $attrs
		]);
	}
} 