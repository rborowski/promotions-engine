<?php

namespace App\Tests\Unit;

use App\DTO\LowestPriceEnquiry;
use App\Entity\Promotion;
use App\Filter\Modifier\DateRangeMultiplier;
use App\Filter\Modifier\EvenItemsMultiplier;
use App\Filter\Modifier\FixedPriceVoucher;
use App\Tests\ServiceTestCase;

class PriceModifiersTest extends ServiceTestCase
{
  /** @test */
  public function DateRangeMultiplier_returns_correctly_modified_price(): void
  {
    //  Given
    $price = 100;
    $quantity = 5;

    $enquiry = new LowestPriceEnquiry();
    $enquiry->setQuantity($quantity);
    $enquiry->setPrice($price);
    $enquiry->setRequestDate("2025-01-01");

    $promotion = new Promotion();
    $promotion->setName('Black Friday half price sale');
    $promotion->setAdjustment(0.5);
    $promotion->setCriteria(["from" => "2024-12-01", "to" => "2025-12-31"]);
    $promotion->setType('date_range_multiplier');

    $dateRangeModifier = new DateRangeMultiplier();

    //  When
    $modifiedPrice = $dateRangeModifier->modify($price, $quantity, $promotion, $enquiry);

    //  Then
    $this->assertEquals(250, $modifiedPrice);
  }

  /** @test */
  public function FixedPriceVoucher_returns_correctly_modified_price(): void
  {
    //  Given
    $price = 100;
    $quantity = 5;

    $enquiry = new LowestPriceEnquiry();
    $enquiry->setQuantity($quantity);
    $enquiry->setPrice($price);
    $enquiry->setRequestCode("OU812");

    $promotion = new Promotion();
    $promotion->setName('Voucher OU812');
    $promotion->setAdjustment(60);
    $promotion->setCriteria(["code" => "OU812"]);
    $promotion->setType('fixed_price_voucher');

    $fixedPriceVoucher = new FixedPriceVoucher();

    //  When
    $modifiedPrice = $fixedPriceVoucher->modify($price, $quantity, $promotion, $enquiry);

    //  Then
    $this->assertEquals(300, $modifiedPrice);
  }

  /** @test */
  public function EvenItemsMultiplier_returns_correctly_modified_price(): void
  {
    //  Given
    $price = 100;
    $quantity = 5;

    $enquiry = new LowestPriceEnquiry();
    $enquiry->setQuantity($quantity);

    $promotion = new Promotion();
    $promotion->setName('Buy one get one free');
    $promotion->setAdjustment(0.5);
    $promotion->setCriteria(["minimum_quantity" => 2]);
    $promotion->setType('even_items_multiplier');

    $evenItemsMultiplier = new EvenItemsMultiplier();

    //  When
    $modifiedPrice = $evenItemsMultiplier->modify($price, $quantity, $promotion, $enquiry);

    //  Then
    $this->assertEquals(300, $modifiedPrice);
  }

  /** @test */
  public function EvenItemsMultiplier_returns_correctly_calculates_alternatives(): void
  {
    //  Given
    $price = 100;
    $quantity = 5;

    $enquiry = new LowestPriceEnquiry();
    $enquiry->setQuantity($quantity);

    $promotion = new Promotion();
    $promotion->setName('Buy one get one half price');
    $promotion->setAdjustment(0.75);
    $promotion->setCriteria(["minimum_quantity" => 2]);
    $promotion->setType('even_items_multiplier');

    $evenItemsMultiplier = new EvenItemsMultiplier();

    //  When
    $modifiedPrice = $evenItemsMultiplier->modify($price, $quantity, $promotion, $enquiry);

    //  Then
    $this->assertEquals(400, $modifiedPrice);
  }
}