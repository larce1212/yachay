<?php

class Comments_Comment extends Yachay_Model_Row_Validation
{
    protected $_validationRules = array(
        'comment' => array(
            'filters' => array('StringTrim', 'StripNewlines', 'StripTags'),
            'validators' => array(
                array(
                    'validator' => 'NotEmpty',
                    'message'   => 'Su comentario no puede estar vacio',
                ),
            ),
        ),
    );

    public function getResource() {
        $model_resources = new Resources();
        return $model_resources->findByIdent($this->resource);
    }

    public function getAuthor() {
        $model_users = new Users();
        return $model_users->findByIdent($this->author);
    }

    public function amAuthor() {
        $user = Zend_Registry::get('user');
        return ($user->ident == $this->author);
    }
}
