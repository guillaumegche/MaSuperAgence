<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "Titre de l'annonce"
            ])
            ->add('description', TextareaType::class, [
                'label' => "Description"
            ])
            ->add('surface', NumberType::class, [
                'label' => "Surface du bien"
            ])
            ->add('rooms', NumberType::class, [
                'label' => "Nombre de pièces"
            ])
            ->add('bedrooms', NumberType::class, [
                'label' => "Nombre de chambres"
            ])
            ->add('florr', NumberType::class, [
                'label' => "Nombre d'étages"
            ])
            ->add('price', MoneyType::class, [
                'label' => "Prix du bien"
            ])
            ->add('heat', ChoiceType::class, [
                'choices' => $this->getChoices()
            ])
            ->add('options', EntityType::class, [
                'class' => Option::class,
                'choice_label' =>'name',
                'multiple' => true
            ])
            ->add('city', TextType::class, [
                'label' => "Ville"
            ])
            ->add('address', TextType::class, [
                'label' => "Nom et n° de la rue"
            ])
            ->add('postal_code', TextType::class, [
                'label' => "Code postal"
            ])
            ->add('country', TextType::class, [
                'label' => "Pays"
            ])
            ->add('sold')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms'
        ]);
    }

    public function getChoices()
    {
        $choices = Property::HEAT;
        $output = [];

        foreach($choices as $k => $v)
        {
            $output[$v] =$k;
        }

        return $output;
    }
}
