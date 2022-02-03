<?php

declare(strict_types=1);

namespace Baraja\Shop\Delivery\Bridge;


use Baraja\Shop\Delivery\Distance;
use Baraja\Shop\Delivery\Entity\BranchInterface;

final class PacketaBranchBridge implements BranchInterface
{
	private int $id;

	private string $name;

	private string $labelRouting;

	private float $latitude;

	private float $longitude;


	/**
	 * @param array{id: int, name: string, labelRouting: string, latitude: float, longitude: float} $data
	 */
	public function __construct(array $data)
	{
		$this->id = $data['id'];
		$this->name = $data['name'];
		$this->labelRouting = $data['labelRouting'];
		$this->latitude = $data['latitude'];
		$this->longitude = $data['longitude'];
	}


	public function getId(): int
	{
		return $this->id;
	}


	public function getName(): string
	{
		return $this->name;
	}


	public function getLabelRouting(): string
	{
		return $this->labelRouting;
	}


	public function getLatitude(): float
	{
		return $this->latitude;
	}


	public function getLongitude(): float
	{
		return $this->longitude;
	}


	public function getDistanceFrom(float $latitude, float $longitude): float
	{
		return Distance::getDistanceFrom($latitude, $longitude, $this->latitude, $this->longitude);
	}
}
