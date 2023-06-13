<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactUsController extends AbstractController
{
    #[Route('/contact-us', name: 'contactus', methods: ['POST'])]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);

        $successMessage = null;

        if($form->isSubmitted() && $form->isValid()){
            /** @var ContactForm $contactForm */
            $contactForm = $form->getData();
            //TODO: send email
            $successMessage = 'Wiadomość została wysłana!!!';
        }
        return $this->render('widget/contact_us.html.twig', [
            'form' => $form,
            'successMessage' => $successMessage,
        ]);
    }
}
