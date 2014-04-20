<?php

namespace fbeck\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    protected $_username;
    protected $_email;
    protected $_locked;
    protected $_expired;
    protected $_admin;
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function __construct($name, $email, $isnonlocked, $isnonexpired, $admin){
        $this->_username = $name;
        $this->_email = $email;
        $this->_locked = ($isnonlocked === true ? false : true);
        $this->_expired = ($isnonexpired === true ? false : true);
        $this->_admin = $admin;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $lock_array = array('required' => false);
        $exp_array = array('required' => false);
        if ($this->_locked === true)
            $lock_array['data'] = true;
        if ($this->_expired === true)
            $exp_array['data'] = true;
        $builder
            ->add('username', 'text',
                array('attr' => array('placeholder' => $this->_username),
                    'required' => false))
            ->add('email', 'text',
                array('attr' => array('placeholder' => $this->_email),
                    'required' => false))
            ->add('locked', 'checkbox', $lock_array)
            ->add('expired', 'checkbox', $exp_array)
            ->add('admin', 'checkbox', array('data' => $this->_admin, 'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        // $resolver->setDefaults(array(
        //     'data_class' => 'fbeck\UserBundle\Entity\User'
        // ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fbeck_userbundle_user';
    }
}
