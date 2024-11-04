<?php

namespace App\Controller;

use App\DTO\LowestPriceEnquiry;
use App\Service\Serializer\DTOSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductsController extends AbstractController
{

  #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: ['POST'])]
  public function lowestPrice(int $id, Request $request, DTOSerializer $serializer ): Response
  {
    if($request->headers->has('force_fail')) {
      return new JsonResponse(
        ['error' => 'Promotions engine failure message'],
        $request->headers->get("force_fail")
      );
    }

    // dd($serializer);

    // 1. EnquiryDTO - deserialize jsons into dtos
    
    /** @var LowestPriceEnquiry $lowestPriceEnquiry */
    $lowestPriceEnquiry = $serializer->deserialize(
      $request->getContent(),
      LowestPriceEnquiry::class,
      'json'
      );

    // 2. Pass the enquiry into the promotions filter
    //    the apropriate promotion will be applied
    // 3. Return a modified Enquiry 

    $lowestPriceEnquiry->setDiscountedPrice(50);
    $lowestPriceEnquiry->setPrice(100);
    $lowestPriceEnquiry->setPromotionId(3);
    $lowestPriceEnquiry->setPromotionName("Black Friday falf price sale");

    $responseContent = $serializer->serialize($lowestPriceEnquiry, 'json');

    return new Response($responseContent, 200);
  }
  
  #[Route('/products/{id}/promotions', name: 'promotions', methods: ['GET', 'POST'])]
  public function promotions(): Response
  {
    return $this->render('template.json');
  }
}