<?php
namespace PingCAP\Constants;

abstract class DefaultValues
{
	// This class should contain constants used for default values

	const SEARCH_NO_RESULTS_MESSAGE = 'No results were found for your search term.';
	const ARCHIVE_NO_RESULTS_MESSAGE = 'No results were found for the selected filters.';
	const AUTHOR_ARCHIVE_NO_RESULTS_MESSAGE = 'No posts were found for this author.';

	const LEVER_POSTINGS_JSON_URL = 'https://api.lever.co/v0/postings/pingcap?mode=json';
	const LEVER_CACHE_TIME_MIN = 15;
}
