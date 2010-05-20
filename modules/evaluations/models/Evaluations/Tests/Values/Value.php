<?php

class modules_evaluations_models_Evaluations_Tests_Values_Value extends Yeah_Model_Row_Validation
{
    protected $_foreignkey = 'test';

    protected $_validationRules = array(
        'label' => array(
            'filters' => array('StringTrim'),
            'validators' => array(
                array(
                    'validator' => 'NotEmpty',
                    'message'   => 'El valor cualitativo no puede estar vacio',
                ),
                array(
                    'validator' => 'StringLength',
                    'options'   => array(1, 64),
                    'message'   => 'El valor cualitativo debe tener entre 1 y 64 caracteres',
                ),
                array(
                    'validator' => 'Regex',
                    'options'   => array('/^[\w\s]+$/i'),
                    'message'   => 'El valor cualitativo debe contener unicamente caracteres y numeros',
                ),
                array(
                    'validator' => 'UniqueLabelDual',
                    'options'   => array(array('evaluations', 'Evaluations_Tests_Values')),
                    'message'   => 'El valor cualitativo ya existe o no puede utilizarse',
                    'namespace' => 'Yeah_Validators',
                ),
            ),
        ),
        'value' => array(
            'filters' => array('StringTrim', 'Int'),
            'validators' => array(
                array(
                    'validator' => 'NotEmpty',
                    'message'   => 'El valor de la nota no puede estar vacio', 
                ),
                array(
                    'validator' => 'StringLength',
                    'options'   => array(1, 4),
                    'message'   => 'El valor de la nota debe tener entre 1 y 4 caracteres',
                ),
                array(
                    'validator' => 'Between',
                    'options'   => array(0, 99),
                    'message'   => 'El valor de la nota no es valida',
                ),
                array(
                    'validator' => 'UniqueValueDual',
                    'options'   => array(array('evaluations', 'Evaluations_Tests_Values')),
                    'message'   => 'El valor de la nota ya existe o no puede utilizarse',
                    'namespace' => 'Yeah_Validators',
                ),
            ),
        ),
    );
}
