<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class BlogPostAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Post')
                ->with('Content')
                    ->add('draft', 'hidden',array('data' => '0'))
                    ->add('title', 'text')
                    ->add('body', 'textarea')
                ->end()
            ->end()

            ->tab('Categories')
                ->with('Meta data')
                    ->add('category', 'sonata_type_model', array(
                        'class' => 'AppBundle\Entity\Category',
                        'property' => 'name',
                    ))
                ->end()
            ->end()


        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('body')
            ->add('category');
    }

    public function toString($object)
    {
        return $object instanceof BlogPost
            ? $object->getTitle()
            : 'Post'; // shown in the breadcrumb on the create view
    }
}