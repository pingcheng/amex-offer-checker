<?php


namespace AmexOfferChecker\Amex;


class OfferDto
{
	private $id = "";

	private $vendor = "";

	private $description = "";

	private $link = "";

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 *
	 * @return OfferDto
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getVendor()
	{
		return $this->vendor;
	}

	/**
	 * @param string $vendor
	 *
	 * @return OfferDto
	 */
	public function setVendor($vendor)
	{
		$this->vendor = $vendor;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 *
	 * @return OfferDto
	 */
	public function setDescription($description)
	{
		$this->description = $description;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLink()
	{
		return $this->link;
	}

	/**
	 * @param string $link
	 *
	 * @return OfferDto
	 */
	public function setLink($link)
	{
		$this->link = $link;
		return $this;
	}
}