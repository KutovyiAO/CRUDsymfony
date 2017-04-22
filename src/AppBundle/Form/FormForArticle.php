<?php

namespace AppBundle\Form;

use AppBundle\entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;


class ArticleForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder->add('name' )
                ->add('description')
                ->add('created_at', DateType::class);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            ['data_class' => Article::class]
        ));
    }



}

