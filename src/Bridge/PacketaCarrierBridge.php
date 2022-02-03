<?php

declare(strict_types=1);

namespace Baraja\Shop\Delivery\Bridge;


use Baraja\DynamicConfiguration\Configuration;
use Baraja\Shop\Delivery\Entity\BranchInterface;
use Baraja\Shop\Delivery\Entity\CarrierInterface;
use Baraja\Zasilkovna\Branch;

final class PacketaCarrierBridge implements CarrierInterface
{
	private ?Branch $branch = null;


	public function __construct(
		private Configuration $configuration,
	) {
	}


	public function getName(): string
	{
		return 'Packeta';
	}


	public function getCode(): string
	{
		return 'packeta';
	}


	public function getBranchById(int $id): BranchInterface
	{
		$branch = $this->getBranchService()->find($id);
		if ($branch === null) {
			throw new \InvalidArgumentException(sprintf('Branch "%d" does not exist.', $id));
		}

		return new PacketaBranchBridge([
			'id' => $id,
			'name' => $branch->getName(),
			'labelRouting' => $branch->getLabelRouting(),
			'latitude' => $branch->getLatitude(),
			'longitude' => $branch->getLongitude(),
		]);
	}


	private function getBranchService(): Branch
	{
		if ($this->branch === null) {
			$apiKey = $this->configuration->get('packeta-api-key', 'shop');
			if ($apiKey === null) {
				throw new \LogicException('API key for Packeta is empty. Did you set "packeta-api-key" option?');
			}
			$this->branch = new Branch($apiKey, httpArgs: ['include-unexported' => 1]);
		}

		return $this->branch;
	}
}
