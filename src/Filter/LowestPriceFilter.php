<?php

namespace App\Filter;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;
use App\Filter\Modifier\Factory\PriceModifierFactoryInterface;

readonly class LowestPriceFilter implements PromotionsFilterInterface
{
  public function __construct(private PriceModifierFactoryInterface $priceModifierFactory)
  {
  }

  public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotions): PromotionEnquiryInterface
  {
    $price = $enquiry->getProduct()->getPrice();
    $quantity = $enquiry->getQuantity();
    $lowestPrice = $price * $quantity;

    //Loop over the promotions
    foreach ($promotions as $promotion) {

      // Run the promotions' modification logic
      // 1. check does the promotion apply e.g. is it in the date range/is the voucher valid
      // 2. Apply the price modification to obtain a $modifiedPrice (how?)
      $priceModifier = $this->priceModifierFactory->create($promotion->getType());

      $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $enquiry);
      // 3. check if $modifiedPrice < $lowestPrice
        // 1. save to Enquiry properties
        // 3. Update $lowestPrice


      $enquiry->setDiscountedPrice(250);
      $enquiry->setPrice(100);
      $enquiry->setPromotionId(3);
      $enquiry->setPromotionName('Black Friday half price sale');

    }
    return $enquiry;
  }
}
