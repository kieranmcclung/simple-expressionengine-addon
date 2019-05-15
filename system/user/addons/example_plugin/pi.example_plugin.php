<?php

class Example_plugin {

	public function truncate()
	{
		// Create variables from EE parameters
		$entry_id = ee()->TMPL->fetch_param('entry_id');
		$limit    = ee()->TMPL->fetch_param('limit') ? : 30;

		// Check whether $entry_id is empty
		if (empty($entry_id))
		{
			return 'Entry ID is missing.';
		}

		// Query the database
		$query = ee()->db->select('title')
			->where('entry_id', $entry_id)
			->get('channel_titles');

		if ($query->num_rows() === 0)
		{
			return 'Sorry, no entry has been found with that ID';
		}
		else
		{
			// Get the title
			$title  = $query->row('title');
			$length = strlen($title);

			// Check whether the title's length is greater than our limit
			if ($length > $limit)
			{
				return substr($title, 0, $limit) . '…';
			}
			else
			{
				return $title;
			}
		}
	}
}