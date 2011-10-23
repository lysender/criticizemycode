<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Contains the code comments
 *
 */
class Controller_Widgets_Comment extends Controller {
	
	public function before()
	{
		parent::before();

		if ( ! defined('MARKDOWN_VERSION'))
		{
			// Load Markdown support
			require Kohana::find_file('vendor', 'markdown/markdown');
		}
	}
	
	/**
	 * Comments for a certain post
	 *
	 */
	public function action_index()
	{
		$code_id = $this->request->param('code_id');
		
		if ($code_id)
		{
			$view = View::factory('widgets/comment/index')
				->bind('comments', $comments);
				
			$comments = $this->_format_comments(
				ORM::factory('comment')
					->where('code_id', '=', $code_id)
					->order_by('date_posted', 'ASC')
					->find_all()
			);
			
			$this->request->response()->body($view);
		}
	}
	
	/**
	 * Formats the comments
	 *
	 * @param object $comments
	 * @return array
	 */
	protected function _format_comments($comments)
	{
		$result = array();
		
		// Purifier
		$purifier = new Purifier_Comment;
		
		foreach ($comments as $comment)
		{
			$result[] = array(
				'comment' => $purifier->purify(Markdown($comment->comment)),
				'author' => $comment->user->username,
				'date_posted' => Date::extra_fuzzy_span($comment->date_posted)
			);
		}
		
		return $result;
	}
}