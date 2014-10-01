<?php

/* (c)Bittion | Created: 18/09/2014 | Developer:reyro | Controller: InvProducts */

App::uses('AppController', 'Controller');

class InvProductsController extends AppController {

//*****************************START CONTROLLERS ********************************
////////////////////////VIEWS
//    Created: 18/09/2014 | Developer: reyro | Description: View Create 
    public function create() {
        
        $fillAutoComplete = $this->_fnFillAutoComplete();
//        debug($fillAutoComplete);
        $this->set('categories', $fillAutoComplete['categories']);
        $this->set('brands', $fillAutoComplete['brands']);
        $this->set('types', $fillAutoComplete['types']);
        $this->set('measures', $fillAutoComplete['measures']);
        $booleans = array(0 => 'No', 1 => 'Si');
        $this->set(compact('booleans'));
    }

//    Created: 18/09/2014 | Developer: reyro | Description: View Update 	
    public function update() {
        if (isset($this->passedArgs['id'])) {
            $id = $this->passedArgs['id'];
        } else {
            $this->redirect(array('action' => 'index'));
        }
        $this->InvProduct->id = $id;
        if (!$this->InvProduct->exists()) {
            $this->redirect(array('action' => 'index'));
        }

        ////////////////////////////////////////////////////////////////////////////////
        $fillAutoComplete = $this->_fnFillAutoComplete();
        $this->set('categories', $fillAutoComplete['categories']);
        $this->set('brands', $fillAutoComplete['brands']);
        $this->set('types', $fillAutoComplete['types']);
        $this->set('measures', $fillAutoComplete['measures']);
        $booleans = array(0 => 'false', 1 => 'true');
        $this->set(compact('booleans'));
        $this->InvProduct->recursive = -1;
        $this->request->data = $this->InvProduct->read(null, $id);
        $lastPrice = $this->InvProduct->InvPrice->find('first', array('conditions' => array('InvPrice.inv_product_id' => $this->request->data['InvProduct']['id']), 'order' => array('InvPrice.id' => 'DESC'), 'fields' => array('InvPrice.price')));
        $this->request->data['InvPrice'][0]['price'] = $lastPrice['InvPrice']['price'];
//        $this->set('InvPrice.0.price', $lastPrice);
    }

//    Created: 18/09/2014 | Developer: reyro | Description: View Index related with fnRead() 	
    public function index() {
        
    }

////////////////////////PUBLIC FUNCTIONS
    //    Created: 18/09/2014 | Developer: reyro | Description: Function Create | Request: Ajax
    public function fnCreate() {
        if ($this->RequestHandler->isAjax()) {
            $response = $this->BittionMain->fnGetMethodResponse('ERROR');
            $currentExrate = $this->CurrentApp->fnCurrentExrateValue();
            if ($currentExrate == '') {
                return new CakeResponse(array('body' => json_encode($this->BittionMain->fnGetMethodResponse('ERROR', array('content' => 'error al obtener el cambio de moneda')))));
            }
            $this->request->data['data'] = Set::filter($this->request->data['data']); //remove empty values
            $this->request->data['data']['InvPrice'][0]['ex_rate'] = $currentExrate;
            $this->request->data['data']['InvProduct']['system_code'] = $this->CurrentApp->fnGenerateCode('PRO', 'InvProduct');
            $this->request->data['data']['InvProduct']['name'] = strtoupper($this->request->data['data']['InvProduct']['name']);
            $this->request->data['data']['InvProduct']['brand'] = strtoupper($this->request->data['data']['InvProduct']['brand']);
            $this->request->data['data']['InvProduct']['category'] = strtoupper($this->request->data['data']['InvProduct']['category']);
            $this->request->data['data']['InvProduct']['type'] = strtoupper($this->request->data['data']['InvProduct']['type']);
            $this->request->data['data']['InvProduct']['measure'] = strtoupper($this->request->data['data']['InvProduct']['measure']);
            $this->request->data['data']['InvProduct']['current_price'] = $this->request->data['data']['InvPrice'][0]['price'];
            $this->InvProduct->create();
            try {
                if ($this->InvProduct->saveAssociated($this->request->data['data'])) {
                    $fillAutoComplete = $this->_fnFillAutoComplete();
                    $response = $this->BittionMain->fnGetMethodResponse('SUCCESS', array('data' => $fillAutoComplete));
                    $response = $this->request->data;
                }
            } catch (Exception $exc) {
                $response = $this->BittionMain->fnGetExceptionResponse($exc->getCode());
            }
            return new CakeResponse(array('body' => json_encode($response)));
        } else {
            $this->redirect($this->Auth->logout()); //only accesible through ajax otherwise logout
        }
    }

//    Created: 18/09/2014 | Developer: reyro | Description: Function Update | Request: Ajax 	
    public function fnUpdate() {
        if ($this->RequestHandler->isAjax()) {
            $response = $this->BittionMain->fnGetMethodResponse('ERROR');
            $currentExrate = $this->CurrentApp->fnCurrentExrateValue();
            if ($currentExrate == '') {
                return new CakeResponse(array('body' => json_encode($this->BittionMain->fnGetMethodResponse('ERROR', array('content' => 'error al obtener el cambio de moneda')))));
            }
            if($this->request->data['data']['InvProduct']['code'] == ''){
               $this->request->data['data']['InvProduct']['code'] = null; 
            }
            if($this->request->data['data']['InvProduct']['description'] == ''){
               $this->request->data['data']['InvProduct']['description'] = null; 
            }
            $this->request->data['data']['InvPrice'][0]['ex_rate'] = $currentExrate;
            $this->request->data['data']['InvProduct']['name'] = strtoupper($this->request->data['data']['InvProduct']['name']);
            $this->request->data['data']['InvProduct']['brand'] = strtoupper($this->request->data['data']['InvProduct']['brand']);
            $this->request->data['data']['InvProduct']['category'] = strtoupper($this->request->data['data']['InvProduct']['category']);
            $this->request->data['data']['InvProduct']['type'] = strtoupper($this->request->data['data']['InvProduct']['type']);
            $this->request->data['data']['InvProduct']['measure'] = strtoupper($this->request->data['data']['InvProduct']['measure']);
            $this->request->data['data']['InvProduct']['current_price'] = $this->request->data['data']['InvPrice'][0]['price'];
            $this->InvProduct->create();

            $response = $this->InvProduct->fnUpdate($this->request->data['data']);
            return new CakeResponse(array('body' => json_encode($response)));
        } else {
            $this->redirect($this->Auth->logout()); //only accesible through ajax otherwise logout
        }
    }

//    Created: 18/09/2014 | Developer: reyro | Description: Function Read for DataTable | Request: Ajax 	
    public function fnRead() {
        if ($this->RequestHandler->isAjax()) {
            //Variables
            $model = 'InvProduct';
            $fields = array($model . '.system_code', $model . '.name', $model . '.measure', $model . '.category', $model . '.type', $model . '.brand', $model . '.current_price', $model . '.id');
            $conditionsOR = array(
                'lower(' . $model . '.system_code) LIKE' => '%' . strtolower($this->request->data['sSearch']) . '%',
                'lower(' . $model . '.name) LIKE' => '%' . strtolower($this->request->data['sSearch']) . '%',
                'lower(' . $model . '.measure) LIKE' => '%' . strtolower($this->request->data['sSearch']) . '%',
                'lower(' . $model . '.category) LIKE' => '%' . strtolower($this->request->data['sSearch']) . '%',
                'lower(' . $model . '.type) LIKE' => '%' . strtolower($this->request->data['sSearch']) . '%',
                'lower(' . $model . '.brand) LIKE' => '%' . strtolower($this->request->data['sSearch']) . '%',
                'CAST(' . $model . '.current_price AS TEXT) LIKE' => '%' . strtolower($this->request->data['sSearch']) . '%',
            );
            $conditions = array('OR' => $conditionsOR /* ,conditions AND */);
            /////////////////////////////////////
            $this->$model->recursive = -1;
            $this->paginate = array(
                'order' => array($fields[$this->request->data['iSortCol_0']] => $this->request->data['sSortDir_0']),
                'limit' => $this->request->data['iDisplayLength'],
                'offset' => $this->request->data['iDisplayStart'],
                'fields' => $fields,
                'conditions' => $conditions
            );
            $arrayPaginate = $this->paginate();
            $total = $this->$model->find('count', array(
                'conditions' => $conditions
            ));
            $array = array('sEcho' => $this->request->data['sEcho']);
            $array['aaData'] = array();
//            $counter = $this->request->data['iDisplayStart'] + 1;
            foreach ($arrayPaginate as $key => $value) {
                //Set datatable columns by column number
                $array['aaData'][$key][0] = $value[$model]['system_code'];
                $array['aaData'][$key][1] = $value[$model]['name'];
                $array['aaData'][$key][2] = $value[$model]['measure'];
                $array['aaData'][$key][3] = $value[$model]['category'];
                $array['aaData'][$key][4] = $value[$model]['type'];
                $array['aaData'][$key][5] = $value[$model]['brand'];
                $array['aaData'][$key][6] = $value[$model]['current_price'];
                $array['aaData'][$key][7] = $value[$model]['id']; //for edit and delete buttons
//                $counter++;
            }
            $array['iTotalRecords'] = $total;
            $array['iTotalDisplayRecords'] = $total;
            return new CakeResponse(array('body' => json_encode($array)));
        } else {
            $this->redirect($this->Auth->logout()); //only accesible through ajax otherwise logout
        }
    }

//    Created: 18/09/2014 | Developer: reyro | Description: Function Delete| Request: Ajax 	
    public function fnDelete() {
        if ($this->RequestHandler->isAjax()) {
            $response = $this->BittionMain->fnGetMethodResponse('ERROR');

            $sales = $this->InvProduct->SalSalesDetail->find('count', array('conditions' => array('SalSalesDetail.inv_product_id' => $this->request->data['id'])));
            if ($sales > 0) {
                $response = $this->BittionMain->fnGetMethodResponse('ERROR', array('title' => 'Acción denegada', 'content' => 'No se puede eliminar, ya fue usado para VENTAS'));
                return new CakeResponse(array('body' => json_encode($response)));
            }
            $offers = $this->InvProduct->SalOffersDetail->find('count', array('conditions' => array('SalOffersDetail.inv_product_id' => $this->request->data['id'])));
            if ($offers > 0) {
                $response = $this->BittionMain->fnGetMethodResponse('ERROR', array('title' => 'Acción denegada', 'content' => 'No se puede eliminar, ya fue usado para COTIZACIONES'));
                return new CakeResponse(array('body' => json_encode($response)));
            }
            ////////////////////////////////////////////////////////////////////////////////////////////////
            $response = $this->InvProduct->fnDelete($this->request->data['id']);
            return new CakeResponse(array('body' => json_encode($response)));
        } else {
            $this->redirect($this->Auth->logout()); //only accesible through ajax otherwise logout
        }
    }

///////////////////////PRIVATE FUNCTIONS

//    Created: 18/09/2014 | Developer: reyro | Description: Fills autocomplete inputs
    private function _fnFillAutoComplete() {
        $categories = $this->InvProduct->find('list', array('fields' => array('InvProduct.category', 'InvProduct.category'), 'group' => array('InvProduct.category')));
        $brands = $this->InvProduct->find('list', array('fields' => array('InvProduct.brand', 'InvProduct.brand'), 'group' => array('InvProduct.brand')));
        $types = $this->InvProduct->find('list', array('fields' => array('InvProduct.type', 'InvProduct.type'), 'group' => array('InvProduct.type')));
        $measures = $this->InvProduct->find('list', array('fields' => array('InvProduct.measure', 'InvProduct.measure'), 'group' => array('InvProduct.measure')));
        return array('categories' => $categories, 'brands' => $brands, 'types'=> $types, 'measures'=>$measures);
    }

    //***************************** END CONTROLLERS ********************************
}
