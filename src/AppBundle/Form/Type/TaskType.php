<?php
namespace AppBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class' => 'AppBundle\Entity\Task']);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task', null, [
                'label' => 'Задание',
                'attr' => ['class' => 'form-control']])
            ->add('list', 'entity', [
                'class' => 'AppBundle:TaskList',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('l')
                        ->orderBy('l.name', 'ASC');
                },
                'property' => 'name',
                'empty_data' => null,
                'placeholder' => 'Выберите список',
                'label' => 'Список',
                'attr' => ['class' => 'form-control']]) 
            ->add('save', 'submit', [
                'attr' => ['class' => 'btn btn-default'],
                'label' => 'Сохранить']);
    }

    public function getName()
    {
        return 'task';
    }
}
