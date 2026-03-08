<?php

namespace App\Form;

use App\Entity\Project;
use App\Enum\TarifTier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Projekt-Titel', 'attr' => ['placeholder' => 'z.B. Hochzeit Müller 2026']])
            ->add('customer', CustomerType::class, ['label' => false])
            ->add('event', EventType::class, ['label' => false])
            ->add('tarifTier', EnumType::class, [
                'class' => TarifTier::class,
                'mapped' => false,
                'label' => 'Tarif',
                'choice_label' => fn (TarifTier $tier) => $tier->label(),
                'expanded' => true,
                'data' => TarifTier::STANDARD,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Project::class]);
    }
}
