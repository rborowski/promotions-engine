<?php

namespace App\Tests\Unit;

use App\DTO\LowestPriceEnquiry;
use App\Event\AfterDtoCreatedEvent;
use App\EventSubscriber\DtoSubscriber;
use App\Service\ServiceException;
use App\Tests\ServiceTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class DtoSubscriberTest extends ServiceTestCase
{

  public function testEventSubscription(): void
  {
    $this->assertArrayHasKey(AfterDtoCreatedEvent::NAME, DtoSubscriber::getSubscribedEvents());
  }

  public function testValidateDto(): void
  {
    // Given
    $dto = new LowestPriceEnquiry();
    $dto->setQuantity(-5);

    $event = new AfterDtoCreatedEvent($dto);

    /** @var EventDispatcherInterface $eventDispatcher */
    $eventDispatcher = $this->container->get(EventDispatcherInterface::class);

    // Expect
    $this->expectException(ServiceException::class);
    $this->expectExceptionMessage('Validation failed');
    // When
    $eventDispatcher->dispatch($event, $event::NAME);

  }
}