<?php
/**
 * Created by PhpStorm.
 * User: justyna
 * Date: 27.01.17
 * Time: 23:51
 */

namespace AppBundle\Controller\Api;


use AppBundle\Form\Type\TemperatureConverterNewType;
use AppBundle\Helper\Temperature;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/api")
 */
class ConverterApiController extends FOSRestController
{

    /**
     * @Route("/post-converter", name="api_converter_post")
     * @Method("POST")
     */

    public function processForm(Request $request)
    {
        $temperature = new Temperature();
        $form = $this->createForm(TemperatureConverterNewType::class, $temperature, ['action' => $this->generateUrl('api_converter_post')]);
        $form->handleRequest($request);
        $convManager = $this->get('converter.manager');
        if ($form->isSubmitted() == true and $form->isValid() == true) {
            $data =  array('newTemp' => $convManager->getNewValueTemp($form->getData()));

            return new Response(json_encode($data), 200);
        }
        $view = View::create($form);
        $view->setTemplate('default/index.html.twig');

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    /**
     * @Route("/get-converter", name="api_converter_get")
     * @Method("GET")
     */

    public function getForm(Request $request)
    {
        $temperature = new Temperature();
        $form = $this->createForm(TemperatureConverterNewType::class, $temperature, ['action' => $this->generateUrl('api_converter_post')]);
        $form->handleRequest($request);
        $view = View::create($form);
        $view->setTemplate('default/index.html.twig');

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}