<?php


namespace AmexOfferChecker\History;


use JsonException;

class History
{
	private $ids = [];

	private $changed = false;

	public function has($id): bool
	{
		$id = trim($id);
		return in_array($id, $this->ids, false);
	}

	public function isChanged(): bool
	{
		return $this->changed;
	}

	public function setIds(string $ids): void
	{
		$ids = trim($ids);
		try {
			$this->ids = json_decode($ids, true, 512, JSON_THROW_ON_ERROR);
		} catch (JsonException $e) {
			$this->ids = [];
		}
	}

	public function addId(string $id): void {
		if (!$this->has($id)) {
			$this->ids[] = $id;
			$this->changed = true;
		}
	}

	public function toString(): string
	{
		return $this->__toString();
	}

	public function __toString(): string
	{
		try {
			$string = json_encode($this->ids, JSON_THROW_ON_ERROR);
			if ($string !== false) {
				return (string) $string;
			}
			return "";
		} catch (JsonException $e) {
			return '';
		}
	}
}