<?php

class shareCartOfficeItemCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'shareCartItem';
    public $classKey = 'shareCartItem';
    public $languageTopics = array('sharecart');
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('sharecart_item_err_name'));
        } elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
            $this->modx->error->addField('name', $this->modx->lexicon('sharecart_item_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'shareCartOfficeItemCreateProcessor';