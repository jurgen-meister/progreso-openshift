<?php /* (c)Bittion Admin Module | Created: 30/07/2014 | Developer:reyro */ ?>
<?php

App::uses('AppModel', 'Model');

/**
 * AdmUser Model
 *
 * @property AdmProfile $AdmProfile
 * @property AdmLogin $AdmLogin
 * @property AdmUserRestriction $AdmUserRestriction
 */
class AdmUser extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'username' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'password' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'adm_role_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'active' => array(
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
    public $hasOne = array(
        'AdmProfile' => array(
            'className' => 'AdmProfile',
            'foreignKey' => 'adm_user_id',
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
    public $belongsTo = array(
        'AdmRole' => array(
            'className' => 'AdmRole',
            'foreignKey' => 'adm_role_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );
    public $hasMany = array(
        'AdmLogin' => array(
            'className' => 'AdmLogin',
            'foreignKey' => 'adm_user_id',
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

    public function fnUpdateUserProfile($data) {
        $dataSource = $this->getDataSource();
        $dataSource->begin();
        ////////////////////////////////////////////
        if (!$this->AdmProfile->save($data['AdmProfile'])) {
            $dataSource->rollback();
            return array('status' => 'ERROR', 'title' => 'Error!', 'content' => 'Perfil no guardado');
        }
        if (!$this->save($data['AdmUser'])) {
            $dataSource->rollback();
            return array('status' => 'ERROR', 'title' => 'Error!', 'content' => 'Usuario no guardado');
        }
        ///////////////////////////////////////////
        $dataSource->commit();
        return array('status' => 'SUCCESS', 'title' => 'Exito!', 'content' => 'Datos guardados'); //message not needed here
    }

///////////
}
