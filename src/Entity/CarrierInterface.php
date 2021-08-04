<?php

declare(strict_types=1);

namespace Baraja\Shop\Delivery\Entity;


interface CarrierInterface
{
	public function getName(): string;

	public function getCode(): string;

	public function getBranchById(int $id): BranchInterface;
}
