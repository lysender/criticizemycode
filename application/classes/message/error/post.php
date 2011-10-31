<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Error message - list display type
 *
 * @package  Message
 * @author   Lysender
 */
class Message_Error_Post extends Kollection_Message {
	
	protected $_display = Kollection_Message::DISPLAY_LIST;
	protected $_type = Kollection_Message::TYPE_ERROR;
	protected $_title = '<strong>ERROR!</strong> Your code was not submitted due to the following errors. Please check and try again:';
}