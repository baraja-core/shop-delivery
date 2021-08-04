<?php

declare(strict_types=1);

namespace Baraja\Shop\Delivery;


use Baraja\Shop\Delivery\Entity\BranchInterface;
use Baraja\Shop\Delivery\Entity\CarrierInterface;
use Baraja\Shop\Delivery\Entity\Delivery;

final class BranchManager
{
	/**
	 * @param CarrierInterface[] $carriers
	 */
	public function __construct(
		private array $carriers,
	) {
	}


	public function getBranchById(Delivery $delivery, int $id): ?BranchInterface
	{
		$carrierCode = $delivery->getCarrier();
		if ($carrierCode === null) { // delivery method does not implement any carrier, branch will not exist
			return null;
		}
		foreach ($this->carriers as $carrier) {
			if ($carrier->getCode() === $carrierCode) {
				return $carrier->getBranchById($id);
			}
		}

		return null;
	}
}
