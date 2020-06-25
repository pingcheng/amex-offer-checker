<?php


namespace AmexOfferChecker\History;


class HistoryLoader
{
	public static function load(string $dir): History
	{
		$history = new History();
		$path = self::getPath($dir);

		if (file_exists($path)) {
			$text = file_get_contents($path);
			$history->setIds($text);
		}

		return $history;
	}

	public static function save(string $dir, History $history): void
	{
		$path = self::getPath($dir);
		file_put_contents($path, $history->toString());
	}

	private static function getPath(string $dir): string
	{
		return $dir.'/history.txt';
	}
}