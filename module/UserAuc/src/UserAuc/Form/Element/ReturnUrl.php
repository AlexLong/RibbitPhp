<?php
/**
 * 
 * User: Windows
 * Date: 1/17/14
 * Time: 12:26 PM
 * 
 */

namespace UserAuc\Form\Element;


use Zend\Form\Element;
use Zend\Form\ElementPrepareAwareInterface;
use Zend\Form\FormInterface;
use Zend\InputFilter\InputProviderInterface;

class ReturnUrl extends  Element implements  InputProviderInterface, ElementPrepareAwareInterface{

    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'hidden',
    );

    /**
     * @var array
     */
    protected $returnUrlValidatorOptions = array();

    /**
     * @var returnUrlValidator
     */
    protected $returnUrlValidator;
    /**
     * Prepare the form element (mostly used for rendering purposes)
     *
     * @param FormInterface $form
     * @return mixed
     */
    public function prepareElement(FormInterface $form)
    {
        // TODO: Implement prepareElement() method.
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInput()}.
     *
     * @return array
     */
    public function getInputSpecification()
    {
        // TODO: Implement getInputSpecification() method.
    }


} 