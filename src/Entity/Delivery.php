<?php

declare(strict_types=1);

namespace Baraja\Shop\Delivery\Entity;


use Baraja\Country\Entity\Country;
use Baraja\EcommerceStandard\DTO\DeliveryInterface;
use Baraja\Localization\TranslateObject;
use Baraja\Localization\Translation;
use Baraja\Shop\Delivery\Repository\DeliveryRepository;
use Baraja\Shop\Price\Price;
use Doctrine\ORM\Mapping as ORM;

/**
 * @method void setName(string $name, ?string $locale = null)
 * @method Translation getName(?string $locale = null)
 */
#[ORM\Entity(repositoryClass: DeliveryRepository::class)]
#[ORM\Table(name: 'shop__delivery')]
class Delivery implements DeliveryInterface
{
	use TranslateObject;

	#[ORM\Id]
	#[ORM\Column(type: 'integer', unique: true, options: ['unsigned' => true])]
	#[ORM\GeneratedValue]
	protected int $id;

	#[ORM\Column(type: 'translate')]
	private Translation $name;

	#[ORM\Column(type: 'string', length: 32, unique: true)]
	private string $code;

	#[ORM\Column(type: 'text', nullable: true)]
	private ?string $description = null;

	/** @var numeric-string */
	#[ORM\Column(type: 'decimal', precision: 15, scale: 4, options: ['unsigned' => true])]
	private string $price;

	/** @var numeric-string|null */
	#[ORM\Column(type: 'decimal', precision: 15, scale: 4, nullable: true, options: ['unsigned' => true])]
	private ?string $priceCod = null;

	#[ORM\Column(type: 'string', length: 7)]
	private ?string $color = null;

	#[ORM\Column(type: 'string', length: 16, nullable: true)]
	private ?string $botShipper = null;

	#[ORM\Column(type: 'string', length: 16, nullable: true)]
	private ?string $botServiceType = null;

	#[ORM\Column(type: 'string', length: 32, nullable: true)]
	private ?string $carrier = null;

	#[ORM\ManyToOne(targetEntity: Country::class)]
	private Country $country;


	/**
	 * @param numeric-string $price
	 */
	public function __construct(string $name, string $code, string $price)
	{
		$this->setName($name);
		$this->code = $code;
		$this->price = Price::normalize($price);
	}


	public function getId(): int
	{
		return $this->id;
	}


	public function getLabel(): string
	{
		return (string) $this->getName();
	}


	public function getCode(): string
	{
		return $this->code;
	}


	public function getDescription(): ?string
	{
		return $this->description;
	}


	public function getPrice(): string
	{
		return Price::normalize($this->price);
	}


	/**
	 * @return numeric-string|null
	 */
	public function getPriceCod(): ?string
	{
		return $this->priceCod !== null ? Price::normalize($this->priceCod) : null;
	}


	/**
	 * @param numeric-string|null $priceCod
	 */
	public function setPriceCod(?string $priceCod): void
	{
		$this->priceCod = $priceCod !== null ? Price::normalize($priceCod) : null;
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


	public function getCarrier(): ?string
	{
		return $this->carrier;
	}


	public function setCarrier(?string $carrier): void
	{
		$this->carrier = $carrier;
	}
}
