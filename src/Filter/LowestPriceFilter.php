<?php

namespace App\Filter;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;

class LowestPriceFilter implements PromotionsFilterInterface
{
  public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotion): PromotionEnquiryInterface
  {
    $price = $enquiry->getProduct()->getPrice();
    $quantity = $enquiry->getQuantity();
    $lowestPrice = $price * $quantity;

    //Loop over the promotions
      // Run the promotions' modification logic
      // 1. check does the promotion apply e.g. is it in the date range/is the voucher valid
      // 2. Apply the price modification to obtain a $modifiedPrice (how?)
//      $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $enquiry);

      // 3. check if $modifiedPrice < $lowestPrice
        // 1. save to Enquiry properties
        // 3. Update $lowestPrice


    $enquiry->setDiscountedPrice(250);
    $enquiry->setPrice(100);
    $enquiry->setPromotionId(3);
    $enquiry->setPromotionName('Black Friday half price sale');

    return $enquiry;
  }
}
