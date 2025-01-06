<?php

namespace App\Filter\Modifier;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;

class FixedPriceVoucher implements PriceModifierInterface
{
  public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquiry): int
  {
    $requestCode = $enquiry->getVoucherCode();
    $code = $promotion->getCriteria()["code"];

    if (!($requestCode === $code )) {
      return $price * $quantity;
    }

    return $promotion->getAdjustment() * $quantity;
  }
}