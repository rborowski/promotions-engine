<?php

namespace App\Tests\Unit;

use App\DTO\LowestPriceEnquiry;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Filter\LowestPriceFilter;
use App\Tests\ServiceTestCase;

class LowestPriceFilterTest extends ServiceTestCase
{
  /** @test */
  public function lowest_price_promotions_filtering_is_applied_correctly(): void
  {
    // Given
    $product = new Product();
    $product->setPrice(100);

    $enquiry = new LowestPriceEnquiry();
    $enquiry->setProduct($product);
    $enquiry->setQuantity(5);
    $enquiry->setRequestDate("2025-02-01");
    $enquiry->setVoucherCode("OU812");

    $promotions = $this->promotionsDataProvider();

    $lowestPriceFilter = $this->container->get(LowestPriceFilter::class);

    // When
    $filteredEnquiry = $lowestPriceFilter->apply($enquiry, ...$promotions);

    // Then
    $this->assertSame(100, $filteredEnquiry->getPrice());
    $this->assertSame(250, $filteredEnquiry->getDiscountedPrice());
    $this->assertSame('Black Friday half price sale', $filteredEnquiry->getPromotionName());

  }

  public function promotionsDataProvider(): array
  {
    $promotions = [];
    $promotionOne = new Promotion();
    $promotionOne->setName('Black Friday half price sale');
    $promotionOne->setAdjustment(0.5);
    $promotionOne->setCriteria(["from" => "2024-12-01", "to" => "2025-12-31"]);
    $promotionOne->setType('date_range_multiplier');
    $promotions[] = $promotionOne;

    $promotionTwo = new Promotion();
    $promotionTwo->setName('Voucher OU812');
    $promotionTwo->setAdjustment(100);
    $promotionTwo->setCriteria(["code" => "OU812"]);
    $promotionTwo->setType('fixed_price_voucher');
    $promotions[] = $promotionTwo;

    $promotionThree = new Promotion();
    $promotionThree->setName('Buy one get one free');
    $promotionThree->setAdjustment(0.5);
    $promotionThree->setCriteria(["minimum_quantity" => 2]);
    $promotionThree->setType('even_items_multiplier');
    $promotions[] = $promotionThree;

    return $promotions;
  }
}