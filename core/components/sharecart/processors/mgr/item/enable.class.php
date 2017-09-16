<?php

class shareCartItemEnableProcessor extends modObjectProcessor
{
    public $objectType = 'shareCartItem';
    public $classKey = 'shareCartItem';
    public $languageTopics = array('sharecart');
    //public $permission = 'save';


    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('sharecart_item_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var shareCartItem $object */
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('sharecart_item_err_nf'));
            }

            $object->set('active', true);
            $object->save();
        }

        return $this->success();
    }

}

return 'shareCartItemEnableProcessor';
