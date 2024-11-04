<?php

namespace App\DTO;

class LowestPriceEnquiry implements PromotionEnquiryInterface
{
  private ?int $productId;

  private ?int $quantity;

  private ?string $requestLocation;

  private ?string $requestCode;

  private ?string $requestDate;
  
  private ?int $price;
  
  private ?int $discountedPrice;
  
  private ?int $promotionId;
  
  private ?string $promotionName;


  /**
   * Get the value of productId
   */ 
  public function getProductId(): int|null
  {
    return $this->productId;
  }

  /**
   * Set the value of productId
   *
   * @return  self
   */ 
  public function setProductId($productId)
  {
    $this->productId = $productId;

    return $this;
  }

  /**
   * Get the value of quantity
   */ 
  public function getQuantity(): int|null
  {
    return $this->quantity;
  }

  /**
   * Set the value of quantity
   *
   * @return  self
   */ 
  public function setQuantity($quantity)
  {
    $this->quantity = $quantity;

    return $this;
  }

  /**
   * Get the value of requestLocation
   */ 
  public function getRequestLocation(): string|null
  {
    return $this->requestLocation;
  }

  /**
   * Set the value of requestLocation
   *
   * @return  self
   */ 
  public function setRequestLocation($requestLocation)
  {
    $this->requestLocation = $requestLocation;

    return $this;
  }

  /**
   * Get the value of requestCode
   */ 
  public function getRequestCode(): string|null
  {
    return $this->requestCode;
  }

  /**
   * Set the value of requestCode
   *
   * @return  self
   */ 
  public function setRequestCode($requestCode)
  {
    $this->requestCode = $requestCode;

    return $this;
  }

  /**
   * Get the value of requestDate
   */ 
  public function getRequestDate(): string|null
  {
    return $this->requestDate;
  }

  /**
   * Set the value of requestDate
   *
   * @return  self
   */ 
  public function setRequestDate($requestDate)
  {
    $this->requestDate = $requestDate;

    return $this;
  }

  /**
   * Get the value of price
   */ 
  public function getPrice(): int|null
  {
    return $this->price;
  }

  /**
   * Set the value of price
   *
   * @return  self
   */ 
  public function setPrice($price)
  {
    $this->price = $price;

    return $this;
  }

  /**
   * Get the value of discountedPrice
   */ 
  public function getDiscountedPrice(): int|null
  {
    return $this->discountedPrice;
  }

  /**
   * Set the value of discountedPrice
   *
   * @return  self
   */ 
  public function setDiscountedPrice($discountedPrice)
  {
    $this->discountedPrice = $discountedPrice;

    return $this;
  }

  /**
   * Get the value of promotionId
   */ 
  public function getPromotionId(): int|null
  {
    return $this->promotionId;
  }

  /**
   * Set the value of promotionId
   *
   * @return  self
   */ 
  public function setPromotionId($promotionId)
  {
    $this->promotionId = $promotionId;

    return $this;
  }

  /**
   * Get the value of promotionName
   */ 
  public function getPromotionName(): string|null
  {
    return $this->promotionName;
  }

  /**
   * Set the value of promotionName
   *
   * @return  self
   */ 
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
