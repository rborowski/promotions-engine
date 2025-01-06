<?php

namespace App\DTO;

use App\Entity\Product;

interface PromotionEnquiryInterface
{
  public function getPromotionId(): ?int;

  public function setPromotionId(int $promotionId): self;

  public function getPromotionName(): ?string;

  public function setPromotionName(string $promotionName): self;

  public function getProduct(): ?Product;
}
