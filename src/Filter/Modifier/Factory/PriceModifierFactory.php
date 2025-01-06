<?php

namespace App\Filter\Modifier\Factory;

use App\Filter\Modifier\PriceModifierInterface;
use Symfony\Component\VarExporter\Exception\ClassNotFoundException;

class PriceModifierFactory implements PriceModifierFactoryInterface
{
  /**
   * @throws ClassNotFoundException
   */
  public function create(string $modifierType): PriceModifierInterface
  {
    $className = str_replace('_', '', ucwords($modifierType, '_'));
    $className = self::PRICE_MODIFIER_NAMESPACE . '\\' . $className;
  
    if (!class_exists($className)) {
        throw new ClassNotFoundException($className);
    }

    return new $className();
  }
}