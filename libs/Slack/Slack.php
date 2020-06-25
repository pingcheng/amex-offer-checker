<?php


namespace AmexOfferChecker\Slack;


use GuzzleHttp\Client;

class Slack
{
	public static function message(string $message): void {
		$client = new Client();
		$client->request('POST', $_ENV['SLACK_CHANNEL'], [
			'json' => [
				'text' => $message
			]
		]);
	}
}