<?php

namespace App\EventSubscriber;

use App\Event\AfterDtoCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DtoSubscriber implements EventSubscriberInterface
{
  public static function getSubscribedEvents(): array
  {
    return [
      AfterDtoCreatedEvent::NAME => 'validateDto'
    ];
  }

  public function validateDto(AfterDtoCreatedEvent $event): void
  {
    // Validate the dto
  }
}