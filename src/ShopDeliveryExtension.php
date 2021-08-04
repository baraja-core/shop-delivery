<?php

declare(strict_types=1);

namespace Baraja\Shop\Delivery;


use Baraja\Doctrine\ORM\DI\OrmAnnotationsExtension;
use Nette\DI\CompilerExtension;

final class ShopDeliveryExtension extends CompilerExtension
{
	public function beforeCompile(): void
	{
		$builder = $this->getContainerBuilder();
		OrmAnnotationsExtension::addAnnotationPathToManager($builder, 'Baraja\Shop\Delivery\Entity', __DIR__ . '/Entity');

		$builder->addDefinition($this->prefix('branchManager'))
			->setFactory(BranchManager::class);
	}
}
