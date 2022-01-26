<?php

declare(strict_types=1);

namespace Baraja\Shop\Delivery\Repository;


use Baraja\Shop\Delivery\Entity\Delivery;
use Doctrine\ORM\EntityRepository;

/**
 * @method Delivery[] findAll()
 */
final class DeliveryRepository extends EntityRepository
{
}
