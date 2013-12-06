<?php

/**
 * Basegrupos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $grupo_pt
 * @property string $grupo_en
 * @property Doctrine_Collection $novidades
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class Basegrupos extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('grupos');
        $this->hasColumn('id', 'integer', 10, array(
             'primary' => true,
             'autoincrement' => true,
             'type' => 'integer',
             'length' => '10',
             ));
        $this->hasColumn('grupo_pt', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('grupo_en', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('novidades', array(
             'local' => 'id',
             'foreign' => 'id_grupo',
             'cascade' => array(
             0 => 'delete',
             )));
    }
}