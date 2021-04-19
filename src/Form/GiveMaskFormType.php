<?php

namespace App\Form;

use App\Entity\Deposit;
use App\Entity\MaskType;
use Doctrine\ORM\EntityManagerInterface;
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
            ->add('date', DateTimeType::class, ['label' => 'Date et heure de Dépôt'])
            ->add('depositLocation', null, [
                'label' => 'Lieu de Dépôt',
                'placeholder' => 'Choisissez une option',
            ]);

        /**
         * @var MaskType $maskType
         */
        foreach ($this->em->getRepository(MaskType::class)->findAll() as $maskType) {
            $builder->add('depositContent' . $maskType->getId(), IntegerType::class, [
                'label' => 'Nb de masque de type ' . $maskType->getLabel(),
                'mapped' => false,
                'required' => false
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
