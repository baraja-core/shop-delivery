<?php

declare(strict_types=1);

namespace Baraja\Shop\Delivery\Entity;


use Baraja\Country\Entity\Country;
use Baraja\Doctrine\Identifier\IdentifierUnsigned;
use Baraja\Localization\TranslateObject;
use Baraja\Localization\Translation;
use Doctrine\ORM\Mapping as ORM;

/**
 * @method void setName(string $name, ?string $locale = null)
 * @method string getName(?string $locale = null)
 */
#[ORM\Entity]
#[ORM\Table(name: 'shop__delivery')]
class Delivery
{
	use IdentifierUnsigned;
	use TranslateObject;

	#[ORM\Column(type: 'translate')]
	private Translation $name;

	#[ORM\Column(type: 'string', length: 32, unique: true)]
	private string $code;

	#[ORM\Column(type: 'text', nullable: true)]
	private ?string $description;

	#[ORM\Column(type: 'integer')]
	private int $price;

	#[ORM\Column(type: 'string', length: 7)]
	private ?string $color = null;

	#[ORM\Column(type: 'string', length: 16, nullable: true)]
	private ?string $botShipper = null;

	#[ORM\Column(type: 'string', length: 16, nullable: true)]
	private ?string $botServiceType = null;

	#[ORM\ManyToOne(targetEntity: Country::class)]
	private Country $country;


	public function __construct(string $name, string $code, int $price)
	{
		$this->setName($name);
		$this->code = $code;
		$this->price = $price;
	}


	public function getCode(): string
	{
		return $this->code;
	}


	public function getDescription(): ?string
	{
		return $this->description;
	}


	public function getPrice(): int
	{
		return $this->price;
	}


	public function getColor(): ?string
	{
		return $this->color;
	}


	public function setColor(?string $color): void
	{
		$this->color = $color;
	}


	public function getBotShipper(): ?string
	{
		return $this->botShipper;
	}


	public function getBotServiceType(): ?string
	{
		return $this->botServiceType;
	}


	public function getCountry(): Country
	{
		return $this->country;
	}


	public function setCountry(Country $country): void
	{
		$this->country = $country;
	}


	public function getCountryCode(): string
	{
		return $this->country->getCode();
	}
}
