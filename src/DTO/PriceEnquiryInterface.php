<?php

namespace App\DTO;

interface PriceEnquiryInterface extends PromotionEnquiryInterface
{
  public function setPrice(int $price): self;

  public function setDiscountedPrice(int $discountedPrice): self;

  public function getQuantity(): ?int;

}