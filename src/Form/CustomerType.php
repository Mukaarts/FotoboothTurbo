<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Kundenname', 'attr' => ['placeholder' => 'Max Mustermann']])
            ->add('email', EmailType::class, ['label' => 'E-Mail', 'attr' => ['placeholder' => 'max@beispiel.de']])
            ->add('company', TextType::class, ['label' => 'Firma', 'required' => false, 'attr' => ['placeholder' => 'Optional']])
            ->add('phone', TelType::class, ['label' => 'Telefon', 'required' => false, 'attr' => ['placeholder' => 'Optional']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Customer::class]);
    }
}
