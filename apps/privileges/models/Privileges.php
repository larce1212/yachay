<?php

class Privileges extends Yachay_Db_Table
{
    protected $_name            = 'privilege';
    protected $_primary         = 'ident';
    protected $_dependentTables = array('Roles_Privileges');
    public    $_mapping         = array(
        'ident'                 => 'Codigo',
        'label'                 => 'Privilegio',
        'package'               => 'Paquete',
        'privilege'             => 'Función',
    );

    // Find uniques indexes
    public function findByIdent($ident) {
        return $this->fetchRow($this->getAdapter()->quoteInto('ident = ?', $ident));
    }

    public function findByLabel($label) {
        return $this->fetchRow($this->getAdapter()->quoteInto('label = ?', $label));
    }

    public function findByModulePrivilege($package, $label) {
        return $this->fetchAll($this->select()
                                    ->where('package = ?', $package)
                                    ->where('label = ?', $label));
    }

    // Selects in table
    public function selectAll() {
        return $this->fetchAll($this->select()->order('package ASC')->order('label ASC'));
    }
}
