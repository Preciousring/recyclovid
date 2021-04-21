<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, ['label' => 'Email'])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Mot de Passe',
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 32,
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\*\.!@$%^&(){}[\]:;<>,.?\/~_+-=|]).{8,32}$/m',
                        'message' => 'Your password must contain a lower case letter, an upper case letter, a digit, and one the following character : * . ! @ $ % ^ & ( ) { } [ ] : ; < > , ? / \ ~ _ + - = |'
                    ])
                ],
            ])
            ->add('firstName', TextType::class, ['label' => 'Prénom'])
            ->add('lastName', TextType::class, ['label' => 'Nom'])
            ->add('address1', TextType::class, ['label' => 'Adresse', 'required' => false])
            ->add('address2', TextType::class, ['label' => 'Complément d\'Adresse', 'required' => false])
            ->add('zipcode', TextType::class, ['label' => 'Code Postal', 'required' => false])
            ->add('city', TextType::class, ['label' => 'Ville', 'required' => false])
            ->add('isCompany', CheckboxType::class, ['label' => 'Je suis une entreprise', 'required' => false])
            ->add('companyName', TextType::class, ['label' => 'Nom de l\'entreprise', 'required' => false])
            ->add('siretNumber', TextType::class, ['label' => 'Numéro de SIRET', 'required' => false])

            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'J\'accepte les conditions d\'utilisation',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions d\'utilisation.',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, ['label' => 'S\'inscrire'] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}