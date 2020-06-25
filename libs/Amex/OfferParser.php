<?php


namespace AmexOfferChecker\Amex;


use PHPHtmlParser\Dom;

class OfferParser
{
	private $html = '';

	private $dom = '';

	public static function parse(string $html): OfferDto
	{
		$parser = new static($html);
		$dto = new OfferDto();
		$dto->setId($parser->getId())
			->setVendor($parser->getVendor())
			->setDescription($parser->getDescription())
			->setLink($parser->getLink());

		return $dto;
	}

	private function __construct(string $html)
	{
		$dom = new Dom();
		$dom->loadStr($html);
		$this->dom = $dom->firstChild();
	}

	private function getId(): string
	{
		return $this->dom->getAttribute('data-gcorid') ?? "";
	}

	private function getVendor(): string
	{
		$vendor = $this->dom->find('h2');
		if ($vendor->count() > 0) {
			return $vendor->offsetGet(0)->text();
		}

		return "Not Found!";
	}

	private function getDescription(): string
	{
		$desc = $this->dom->find('.benefits-list li');
		if ($desc->count() > 0) {
			return $desc->offsetGet(0)->text;
		}

		return "";
	}

	private function getLink(): string
	{
		$link = $this->dom->find('a.vDOther');
		if ($link->count() > 0) {
			$url = $link->offsetGet(0)->getAttribute('href');
			$url = ltrim($url, '.');
			return "https://www.americanexpress.com/au/network{$url}";
		}

		return "";
	}

}