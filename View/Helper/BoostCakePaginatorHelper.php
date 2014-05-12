<?php
namespace BoostCake\View\Helper;

use Cake\View\Helper\PaginatorHelper;

class BoostCakePaginatorHelper extends PaginatorHelper {

	public $helpers = array('Html' => array(
		'className' => 'BoostCake.BoostCakeHtml'
	));

/**
 * Construct the widgets and binds the default context providers
 *
 * @param \Cake\View\View $View   The View this helper is being attached to.
 * @param array           $config Configuration settings for the helper.
 */

	public function pagination(array $options = array()) {
		$default = array(
			'div' => false,
			'ul' => 'pagination',
			'text' => array(
				'first' => '<<',
				'prev' => '<',
				'next' => '>',
				'last' => '>>'
			)
		);

		$model = (empty($options['model'])) ? $this->defaultModel() : $options['model'];

		$pageCount = $this->request->params['paging'][$model]['pageCount'];
		if ($pageCount < 2) {
			// Don't display pagination if there is only one page
			return '';
		}
		if ($pageCount == 2) {
			// If only two pages, don't show duplicate prev/next buttons
			$default['units'] = array('prev', 'numbers', 'next');
		} else {
			$default['units'] = array('first', 'prev', 'numbers', 'next', 'last');
		}

		$options += $default;

		$units = $options['units'];
		unset($options['units']);
		$text = $options['text'];
		unset($options['text']);
		$div = $options['div'];
		unset($options['div']);
		$ul = ($options['ul']) ? array('class' => $options['ul']) : array();
		unset($options['ul']);

		$out = array();
		foreach ($units as $unit) {
			if ($unit === 'numbers') {
				$out[] = $this->{$unit}($options);
			} else {
				$out[] = $this->{$unit}($text[$unit], $options);
			}
		}
		$out = $this->Html->tag('ul', implode("\n", $out), $ul);
		if ($div !== false) {
			$out = $this->Html->div($div, $out);
		}
		return $out;
	}
}
