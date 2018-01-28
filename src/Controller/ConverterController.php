<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Form\Type\TemperatureConverterNewType;
use App\Helper\Temperature;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConverterController
 * @package App\Controller
 */
class ConverterController extends Controller
{

    /**
     * @Route("/", name="converter")
     */
    public function converterFormAction(Request $request)
    {
        $temperature = new Temperature();
        $form = $this->createForm(TemperatureConverterNewType::class, $temperature);
        $form ->handleRequest($request);
        $convManager = $this->get('converter.manager');
        if ($form->isSubmitted() == true and $form->isValid() == true) {
            return $this->render('default/afterValidSubmit.html.twig', [
                'form' => $form->createView(),
                'newTemp'   => $convManager->getNewValueTemp($form->getData()),
            ]);
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
