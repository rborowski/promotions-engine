<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductsController extends AbstractController
{

  #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: ['GET', 'POST'])]
  public function lowestPrice(int $id, Request $request): Response
  {
    if($request->headers->has('force_fail')) {
      return new JsonResponse(
        ['error' => 'Promotions engine failure message'],
        $request->headers->get("force_fail")
      );
    }

    return new JsonResponse ([
        "quantity" => 5,
        "request_location" => "UK",
        "voucher_code" => "OU812",
        "request_date" => "2022-04-04",
        "product_id" => $id,
        "price" => 100,
        'discounted_price' => 50,
        'promotion_id'=> 3,
        'promotion_name' => 'Black Friday sale'

    ], 200);
  }

  // 1. EnquiryDTO - deserialize jsons
  // 2. Pass the enquiry into the promotions filter
  //    the apropriate promotion will be applied
  // 3. Return a modified Enquiry 

  //Promotion
  // - does this apply
  // - add to the EnquiryDTO or Modify the DTO


  #[Route('/products/{id}/promotions', name: 'promotions', methods: ['GET', 'POST'])]
  public function promotions(): Response
  {

    return $this->render('template.json');
  }
}