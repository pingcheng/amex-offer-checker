<?php

use AmexOfferChecker\Amex\OfferParser;
use AmexOfferChecker\History\HistoryLoader;
use AmexOfferChecker\Slack\Slack;
use Dotenv\Dotenv;
use GuzzleHttp\Client;
use PHPHtmlParser\Dom;

require_once __DIR__.'/vendor/autoload.php';

Dotenv::createImmutable(__DIR__)->load();

$url = $_ENV['OFFER_URL'];

$history = HistoryLoader::load(__DIR__);

$client = new Client();
$response = $client->get($url);

if ($response->getStatusCode() !== 200) {
	Slack::message('WatchDog - Amex Offer - Failed to fetch HTML content');
	exit();
}
$html = $response->getBody()->getContents();

$dom = new Dom();
$dom->loadStr($html);
$offers = $dom->find('.offer-tile');

$messages = [];

$offers->each(static function (Dom\HtmlNode $node) use (&$history, &$messages) {
	$offer = OfferParser::parse($node->outerHtml());
	if ($history->has($offer->getId())) {
		return;
	}

	$messages[] = "{$offer->getVendor()} - {$offer->getDescription()} - {$offer->getLink()}";
	$history->addId($offer->getId());
});

if (!empty($messages)) {
	Slack::message("New Offers!\n" . implode("\n", $messages));
}

if ($history->isChanged()) {
	HistoryLoader::save(__DIR__, $history);
}