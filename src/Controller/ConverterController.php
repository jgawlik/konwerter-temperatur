<?php

namespace App\Controller;

use App\Exception\InvalidTemperatureUnitException;
use App\Service\UnitConverterService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Form\Type\TemperatureConverterNewType;
use App\Form\Model\Temperature;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ConverterController extends Controller
{
    private $unitConverterService;

    public function __construct(UnitConverterService $unitConverterService)
    {
        $this->unitConverterService = $unitConverterService;
    }

    /**
     * @Route("/", name="converter")
     */
    public function converterFormAction(Request $request)
    {

        $temperature = new Temperature();
        $form = $this->createForm(TemperatureConverterNewType::class, $temperature);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                return $this->render('default/afterValidSubmit.html.twig', [
                    'form' => $form->createView(),
                    'newTemperature' => $this->unitConverterService->convertTemperature($form->getData()),
                ]);
            } catch (InvalidTemperatureUnitException $invalidTemperatureUnitException) {
                $this->addFlash(
                    'danger',
                    $invalidTemperatureUnitException->getMessage()
                );
                return $this->render('default/index.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
