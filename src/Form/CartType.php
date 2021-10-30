<?php

namespace App\Form;

use App\Entity\Cart;
use App\Entity\Mobile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity',IntegerType::class,
            [
                'label'=> 'Quantity',
            ])
            ->add('product',EntityType::class,
            [
                'label'=> 'Product',
                'class' => Mobile::class,
                'choice_label' => "name",
                'multiple' => false,
                'expanded' => false 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cart::class,
        ]);
    }
}
