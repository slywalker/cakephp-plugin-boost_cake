<?php
namespace BoostCake\View\Helper;

use Cake\View\View;

class PaginatorHelper extends \Cake\View\Helper\PaginatorHelper {

	public $helpers = ['Html', 'Url', 'Number'];

	protected $_bootstrapTemplates = [
		'current' => '<li class="active"><span>{{text}} <span class="sr-only">(current)</span></span></li>',
		'ellipsis' => '<li class="ellipsis"><span>...</span></li>',
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
	}

/**
 * Construct the widgets and binds the default context providers
 *
 * @param \Cake\View\View $View   The View this helper is being attached to.
 * @param array           $config Configuration settings for the helper.
 */
	public function pagination(array $options = []) {
		$default = [
			'div' => false,
			'ul' => 'pagination',
			'text' => [
				'first' => '<<',
				'prev' => '<',
				'next' => '>',
				'last' => '>>'
			]
		];

		$model = (empty($options['model'])) ? $this->defaultModel() : $options['model'];

		$pageCount = $this->request->params['paging'][$model]['pageCount'];
		if ($pageCount < 2) {
			// Don't display pagination if there is only one page
			return '';
		}
		if ($pageCount == 2) {
			// If only two pages, don't show duplicate prev/next buttons
			$default['units'] = ['prev', 'numbers', 'next'];
		} else {
			$default['units'] = ['first', 'prev', 'numbers', 'next', 'last'];
		}

		$options += $default;

		$units = $options['units'];
		unset($options['units']);
		$text = $options['text'];
		unset($options['text']);
		$div = $options['div'];
		unset($options['div']);
		$ul = ($options['ul']) ? ['class' => $options['ul']] : [];
		unset($options['ul']);

		$out = [];
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
