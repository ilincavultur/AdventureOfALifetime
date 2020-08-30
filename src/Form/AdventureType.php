<?php


namespace App\Form;


use App\Entity\Adventure;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

class AdventureType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Location', TextType::class)
            ->add('Date', DateType::class)
            ->add('Type', ChoiceType::class, [
                'choices' => [
                    'Hiking' => Adventure::TYPE_HIKING ,
                    'Skiing' => Adventure::TYPE_SKIING,
                    'Surfing' => Adventure::TYPE_SURFING ,
                    'Swimming' => Adventure::TYPE_SWIMMING ,
                    'Snowboarding' => Adventure::TYPE_SNOWBOARDING,
                    'Riding' => Adventure::TYPE_RIDING ,
                    'Sailing' => Adventure::TYPE_SAILING ,
                ],

            ])
        ;


    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adventure::class
        ]);
    }



}