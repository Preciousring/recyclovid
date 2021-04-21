<?php

namespace App\Form;

use App\Entity\Deposit;
use App\Entity\DepositLocation;
use App\Entity\MaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GiveMaskFormType extends AbstractType
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, [
                'label' => 'Date et heure de Dépôt',
                'attr' => ['class' => 'width-100'],
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',

            ])
            ->add('depositLocation', EntityType::class, [
                'class' => DepositLocation::class,
                'label' => 'Lieu de Dépôt',
                'placeholder' => 'Choisissez une option',
                'attr' => ['class' => 'width-100 select-mz-gc'],
            ]);

        /**
         * @var MaskType $maskType
         */
        foreach ($this->em->getRepository(MaskType::class)->findAll() as $maskType) {
            $builder->add('depositContent' . $maskType->getId(), IntegerType::class, [
                'label' => 'Nombre de masques de type ' . $maskType->getLabel(),
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'width-100 select-mz-gc'],
            ]);
        }

        $builder->add('submit', SubmitType::class, ['label' => 'Je contribue !']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Deposit::class,
        ]);
    }
}
