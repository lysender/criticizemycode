<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Purifier for code posts
 *
 */
class Purifier_Comment extends Purifier_Abstract {
	
	protected $_allowed = 'p, pre, code, strong, em, b';
}