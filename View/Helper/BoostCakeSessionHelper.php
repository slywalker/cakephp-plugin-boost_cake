<?php
App::uses('SessionHelper', 'View/Helper');

class BoostCakeSessionHelper extends SessionHelper {

/**
 * Overwrite SessionHelper:flash()
 * If no option plugin set, then use BoostCake plugin.
 * Only change from original Session helper is the line
 * else { $options['plugin'] = 'BoostCake'; }
 *
 * @param string $key The [Message.]key you are rendering in the view.
 * @param array $attrs Additional attributes to use for the creation of this flash message.
 *    Supports the 'params', and 'element' keys that are used in the helper.
 * @return string
 */
	public function flash($key = 'flash', $attrs = array()) {
		$out = false;

		if (CakeSession::check('Message.' . $key)) {
			$flash = CakeSession::read('Message.' . $key);
			$message = $flash['message'];
			unset($flash['message']);

			if (!empty($attrs)) {
				$flash = array_merge($flash, $attrs);
			}

			if ($flash['element'] === 'default') {
				$class = 'message';
				if (!empty($flash['params']['class'])) {
					$class = $flash['params']['class'];
				}
				$out = '<div id="' . $key . 'Message" class="' . $class . '">' . $message . '</div>';
			} elseif (!$flash['element']) {
				$out = $message;
			} else {
				$options = array();
				if (isset($flash['params']['plugin'])) {
					$options['plugin'] = $flash['params']['plugin'];
				}
				else {
					$options['plugin'] = 'BoostCake';
				}
				$tmpVars = $flash['params'];
				$tmpVars['message'] = $message;
				$out = $this->_View->element($flash['element'], $tmpVars, $options);
			}
			CakeSession::delete('Message.' . $key);
		}
		return $out;
	}
}