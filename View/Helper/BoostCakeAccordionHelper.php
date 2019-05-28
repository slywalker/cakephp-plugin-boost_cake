<?php
/**
 * Helper to assist in the usage of Boostratp 3 Accordion JS
 *
 * @link http://getbootstrap.com/javascript/#collapse
 *
 * Usage:
 *   $helpers = array('Accordion' => array('className' => 'BoostCake.BoostCakeAccordion'));
 *
 *   $this->Accordion->create(array(
 *     'thing 1' => 'lorem ipsum...',
 *     'thing 2' => 'foobar and stuff...',
 *   ));
 *
 *   $this->Accordion->create(array(
 *     array(
 *       'heading' => 'thing 1',
 *       'body' => 'lorem ipsum...',
 *     ),
 *     array(
 *       'heading' => 'thing 2',
 *       'body' => 'foobar and stuff...',
 *     ),
 *   ));
 */
class BoostCakeAccordionHelper extends AppHelper {

	/**
	 * Create an Accordion from groupped data
	 *
	 * @param array $data
	 *    - array( array('heading' => '...', 'body' => '...'), ... )
	 *      in this case, we loop through all nodes and look for explicitly set 'heading' and 'body'
	 *    - array( 'group1' => '...')
	 *      in this case 'group1' is the heading, and the value '...' is the body
	 * @param array $options
	 *    'panelClass' = 'panel-default'
	 *    'id' = uniqueId()
	 *    'inCount' = 1 (int of the group you want displayed by default)
	 * @return string $html for Accordion
	 */
	public function create($data, $options = array()) {
		if (empty($data) || !is_array($data)) {
			return '';
		}
		$defaults = array(
			'id' => $this->uniqueId(),
			'panelClass' => 'panel-default',
			'count' => 1,
			'inCount' => 1,
		);
		$options = Hash::merge($defaults, $options);
		$nodes = array();
		foreach ($data as $key => $val) {
			if (is_array($val)) {
				// passed in an array for $val (explicitly setting heading and body
				$nodes[] = $this->node($val, $options);
			} else {
				// passed in $key = heading, and $val = body
				$nodes[] = $this->node(array('heading' => $key, 'body' => $val), $options);
			}
			$options['count']++;
		}
		return sprintf('<div class="panel-group" id="%s">%s</div>', $options['id'], implode("\n", $nodes));
	}

	/**
	 * Process a single node for the Accordion
	 *
	 * @param array data
	 * @param array $options
	 * @return string $html for node
	 */
	public function node($data, $options) {
		$parentId = $options['id'];
		$id = "{$parentId}-{$options['count']}";
		$heading = (empty($data['heading']) ? '' : $data['heading']);
		$body = (empty($data['body']) ? '' : $data['body']);
		$heading = sprintf('<div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#%s" href="#%s">%s</a></h4></div>',
			$parentId,
			$id,
			$heading
		);
		$body = sprintf('<div id="%s" class="panel-collapse collapse %s"><div class="panel-body">%s</div></div>',
			$id,
			($options['count'] == $options['inCount'] ? 'in' : ''),
			$body
		);
		return sprintf('<div class="panel %s">%s%s</div>',
			$options['panelClass'],
			$heading,
			$body
		);
	}

	/**
	 * This is a function to return a unique key
	 *
	 * @return string $uniqueId
	 */
	public function uniqueId() {
		App::uses('String', 'Utility');
		$uniqueId = 'u' . String::uuid();
		$uniqueId = preg_replace('#[^a-z0-9_]#', '', $uniqueId);
		return $uniqueId;
	}
}
