<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskListType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class' => 'AppBundle\Entity\TaskList']);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Список',
                'attr' => ['class' => 'form-control']])
             ->add('save', 'submit', [
                'label' => 'Сохранить',
                'attr' => ['class' => 'btn btn-default']]);
    }

    public function getName()
    {
        return 'taskList';
    }
}
