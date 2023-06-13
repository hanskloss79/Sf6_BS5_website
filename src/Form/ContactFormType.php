<?php

namespace App\Form;

use App\ValueObject\ContactForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $formTypeOptions = [
            'row_attr' => [
                'class' => 'mb-3',
            ],
        ];

        $builder
            ->add('name', TextType::class, array_merge($formTypeOptions, [
                'label' => 'Nadawca',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Nadawca jest wymagany.',
                    ])
                ]
            ]))
            ->add('email', EmailType::class, array_merge($formTypeOptions, [
                'label' => 'Email nadawcy',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Email nadawcy jest wymagany.'
                    ])
                ]
            ]))
            ->add('subject', TextType::class, array_merge($formTypeOptions, [
                'label' => 'Temat:',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Proszę wpisać temat wiadomości.'
                    ])
                ]
            ]))
            ->add('message', TextareaType::class, array_merge($formTypeOptions, [
                'label' => 'Wiadomość:',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Proszę wpisać treść wiadomości.'
                    ])
                ]
            ]))
            ->add('close', ButtonType::class, [
                'row_attr' => [
                    'class' => 'w-25 d-inline-block'
                ],
                'attr' => [
                    'class' => 'btn btn-secondary',
                    'data-bs-dismiss' => "modal"
                ],
                'label' => 'Zamknij'
            ])
            ->add('submit', SubmitType::class, [
                'row_attr' => [
                    'class' => 'w-50 d-inline-block'
                ],
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
                'label' => 'Wyślij wiadomość'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class,
        ]);
    }
}
