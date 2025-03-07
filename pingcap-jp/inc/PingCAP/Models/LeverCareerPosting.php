<?php
namespace PingCAP\Models;

class LeverCareerPosting
{
	public string $group = '';
	public string $department = '';
	public string $title = '';
	public string $location = '';
	public string $commitment = '';
	public string $url = '';

	public function __construct(
		string $group = '',
		string $department = '',
		string $title = '',
		string $location = '',
		string $commitment = '',
		string $url = ''
	) {
		$this->group = $group;
		$this->department = $department;
		$this->title = $title;
		$this->location = $location;
		$this->commitment = $commitment;
		$this->url = $url;
	}

	public function __serialize(): array
	{
		return [
			'group' => $this->group,
			'department' => $this->department,
			'title' => $this->title,
			'location' => $this->location,
			'commitment' => $this->commitment,
			'url' => $this->url
		];
	}

	public function __unserialize(array $data): void
	{
		$this->group = $data['group'] ?? '';
		$this->department = $data['department'] ?? '';
		$this->title = $data['title'] ?? '';
		$this->location = $data['location'] ?? '';
		$this->commitment = $data['commitment'] ?? '';
		$this->url = $data['url'] ?? '';
	}
}
