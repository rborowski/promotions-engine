<?php

namespace App\Controller;

use App\Cache\PromotionCache;
use App\DTO\LowestPriceEnquiry;
use App\Filter\PromotionsFilterInterface;
use App\Repository\ProductRepository;
use App\Service\Serializer\DTOSerializer;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductsController extends AbstractController
{

  public function __construct(
    private readonly ProductRepository $repository,
    private readonly EntityManagerInterface $entityManager
  ) {
  }

  /**
   * @throws InvalidArgumentException
   */
  #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: ['POST'])]
  public function lowestPrice(
    Request $request,
    int $id,
    DTOSerializer $serializer,
    PromotionsFilterInterface $promotionsFilter,
    PromotionCache $promotionsCache
  ): Response
  {
    throw new \JsonException('Your json sucks');

    /** @var LowestPriceEnquiry $lowestPriceEnquiry */
    $lowestPriceEnquiry = $serializer->deserialize(
      $request->getContent(),
      LowestPriceEnquiry::class,
      'json'
    );

    $product = $this->repository->findOrFail($id); // add error handling for not found product

    $lowestPriceEnquiry->setProduct($product);

    $promotions = $promotionsCache->findValidForProduct($product, $lowestPriceEnquiry->getRequestDate());

    $modifiedEnquiry = $promotionsFilter->apply($lowestPriceEnquiry, ...$promotions);
    $responseContent = $serializer->serialize($modifiedEnquiry, 'json');

    return new Response($responseContent, 200, ['Content-Type' => 'application/json']);
  }

  #[Route('/products/{id}/promotions', name: 'promotions', methods: ['GET', 'POST'])]
  public function promotions(): Response
  {
    return $this->render('template.json');
  }
}