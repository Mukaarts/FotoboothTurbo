<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('eventDate', DateType::class, ['label' => 'Event-Datum', 'widget' => 'single_text'])
            ->add('location', TextType::class, ['label' => 'Location', 'attr' => ['placeholder' => 'z.B. Schloss Bensberg']])
            ->add('notes', TextareaType::class, ['label' => 'Notizen', 'required' => false, 'attr' => ['rows' => 4, 'placeholder' => 'Besonderheiten, Wunsch-Stil, Farben etc.']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Event::class]);
    }
}
