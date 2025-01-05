<?php

namespace App\DTO;

use App\Entity\Product;
use Symfony\Component\Serializer\Attribute\Ignore;

class LowestPriceEnquiry implements PromotionEnquiryInterface
{
  #[Ignore]
  private ?Product $product;

  private ?int $quantity;

  private ?string $requestLocation;

  private ?string $requestCode;

  private ?string $requestDate;
  
  private ?int $price;
  
  private ?int $discountedPrice;
  
  private ?int $promotionId;
  
  private ?string $promotionName;

  public function getProduct(): ?Product
  {
    return $this->product;
  }

  public function setProduct($product): static
  {
    $this->product = $product;

    return $this;
  }

  public function getQuantity(): int|null
  {
    return $this->quantity;
  }

  public function setQuantity($quantity): static
  {
    $this->quantity = $quantity;

    return $this;
  }

  public function getRequestLocation(): string|null
  {
    return $this->requestLocation;
  }

  public function setRequestLocation($requestLocation): static
  {
    $this->requestLocation = $requestLocation;

    return $this;
  }

  public function getRequestCode(): string|null
  {
    return $this->requestCode;
  }

  public function setRequestCode($requestCode): static
  {
    $this->requestCode = $requestCode;

    return $this;
  }

  public function getRequestDate(): string|null
  {
    return $this->requestDate;
  }

  public function setRequestDate($requestDate): static
  {
    $this->requestDate = $requestDate;

    return $this;
  }

  public function getPrice(): int|null
  {
    return $this->price;
  }

  public function setPrice($price): static
  {
    $this->price = $price;

    return $this;
  }

  public function getDiscountedPrice(): int|null
  {
    return $this->discountedPrice;
  }

  public function setDiscountedPrice($discountedPrice): static
  {
    $this->discountedPrice = $discountedPrice;

    return $this;
  }

  public function getPromotionId(): int|null
  {
    return $this->promotionId;
  }

  public function setPromotionId($promotionId): static
  {
    $this->promotionId = $promotionId;

    return $this;
  }

  public function getPromotionName(): string|null
  {
    return $this->promotionName;
  }

  public function setPromotionName($promotionName): static
  {
    $this->promotionName = $promotionName;

    return $this;
  }

  public function jsonSerialize(): array 
  {
    return get_object_vars($this);
  }
}
