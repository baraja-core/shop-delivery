<?php

declare(strict_types=1);

namespace Baraja\Shop\Delivery;


use Baraja\Doctrine\ORM\DI\OrmAnnotationsExtension;
use Baraja\Shop\Delivery\Bridge\PacketaCarrierBridge;
use Baraja\Zasilkovna\Branch;
use Nette\DI\CompilerExtension;

final class ShopDeliveryExtension extends CompilerExtension
{
	public function beforeCompile(): void
	{
		$builder = $this->getContainerBuilder();
		OrmAnnotationsExtension::addAnnotationPathToManager($builder, 'Baraja\Shop\Delivery\Entity', __DIR__ . '/Entity');

		$builder->addDefinition($this->prefix('branchManager'))
			->setFactory(BranchManager::class);

		if (class_exists(Branch::class)) {
			$builder->addDefinition($this->prefix('packetaCarrierBridge'))
				->setFactory(PacketaCarrierBridge::class)
				->setAutowired(PacketaCarrierBridge::class);
		}
	}
}
