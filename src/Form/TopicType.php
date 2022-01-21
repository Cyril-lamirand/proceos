<?php

namespace App\Form;

use App\Entity\Forum;
use App\Entity\Topic;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TopicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('createdat')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email'
            ])
            ->add('forum', EntityType::class, [
                'class' => Forum::class,
                'choice_label' => "label",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Topic::class,
        ]);
    }
}
