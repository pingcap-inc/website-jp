<?php
namespace PingCAP\Constants;

abstract class DateFormat
{
	const COMMUNITY_ACTIVITY = 'M j, Y';
	const COMMUNITY_ACTIVITY_NO_YEAR = 'M j';

	const EVENT_CALENDAR = 'M j, Y g:i a';
	const EVENT_CALENDAR_NO_YEAR = 'M j g:i a';
	const EVENT_CALENDAR_MONTH_DAY = 'M j';
	const EVENT_CALENDAR_TIME = 'g:i a';
	const EVENT_CALENDAR_NO_TIME = 'M j, Y';
}
