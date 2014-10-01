<?php

App::uses('AppModel', 'Model');

/**
 * InvProduct Model
 *
 * @property InvPrice $InvPrice
 * @property SalOffersDetail $SalOffersDetail
 * @property SalSalesDetail $SalSalesDetail
 */
class InvProduct extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $virtualFields = array("full_name" => "CONCAT('[ ',InvProduct.system_code, ' ] ' ,InvProduct.name)");
    public $displayField = 'full_name';
//    public $displayField = 'name';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'system_code' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'measure' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'category' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'type' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'brand' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'website' => array(
            'boolean' => array(
                'rule' => array('boolean'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'InvPrice' => array(
            'className' => 'InvPrice',
            'foreignKey' => 'inv_product_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'SalOffersDetail' => array(
            'className' => 'SalOffersDetail',
            'foreignKey' => 'inv_product_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'SalSalesDetail' => array(
            'className' => 'SalSalesDetail',
            'foreignKey' => 'inv_product_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public function fnUpdate($data) {
        $dataSource = $this->getDataSource();
        $dataSource->begin();
        ////////////////////////////////////////////
//debug($data);
        $lastPrice = $this->InvPrice->find('first', array('conditions' => array('InvPrice.inv_product_id' => $data['InvProduct']['id']), 'order' => array('InvPrice.id' => 'DESC'), 'fields' => array('InvPrice.price')));

        if ($lastPrice['InvPrice']['price'] != $data['InvPrice'][0]['price']) {
            $price = array('price' => $data['InvPrice'][0]['price'], 'ex_rate' => $data['InvPrice'][0]['ex_rate'], 'inv_product_id' => $data['InvProduct']['id']);
            if (!$this->InvPrice->save($price)) {
                $dataSource->rollback();
                return array('status' => 'ERROR', 'title' => 'Error!', 'content' => 'Precio no guardado');
            }
        }
//        unset($data['InvPrice']);
//        debug($data);
        if (!$this->save($data)) {
            $dataSource->rollback();
            return array('status' => 'ERROR', 'title' => 'Error!', 'content' => 'Producto no guardado');
        }
        $fillAutoComplete = $this->_fnFillAutoComplete();
        ///////////////////////////////////////////
        $dataSource->commit();
        return array('status' => 'SUCCESS', 'title' => 'Exito!', 'content' => 'Datos guardados', 'data' => $fillAutoComplete); //message not needed here
    }

    private function _fnFillAutoComplete() {
        $categories = $this->find('list', array('fields' => array('InvProduct.category', 'InvProduct.category'), 'group' => array('InvProduct.category')));
        $brands = $this->find('list', array('fields' => array('InvProduct.brand', 'InvProduct.brand'), 'group' => array('InvProduct.brand')));
        return array('categories' => $categories, 'brands' => $brands);
    }

    public function fnDelete($id) {
        $dataSource = $this->getDataSource();
        $dataSource->begin();
        ////////////////////////////////////////////
        $prices = $this->InvPrice->find('list', array('fields' => array('InvPrice.id', 'InvPrice.id'), 'conditions' => array('InvPrice.inv_product_id' => $id)));
        foreach ($prices as $value) {
            $this->InvPrice->id = $value;
            if (!$this->InvPrice->delete()) {
                $dataSource->rollback();
                return array('status' => 'ERROR', 'title' => 'Error!', 'content' => 'Precio no eliminado');
            }
        }

        $this->id = $id;
        if (!$this->delete()) {
            $dataSource->rollback();
            return array('status' => 'ERROR', 'title' => 'Error!', 'content' => 'Producto no eliminado');
        }
        ///////////////////////////////////////////
        $dataSource->commit();
        return array('status' => 'SUCCESS', 'title' => 'Exito!', 'content' => 'Producto eliminado'); //message not needed here
    }

//END CLASS
}
