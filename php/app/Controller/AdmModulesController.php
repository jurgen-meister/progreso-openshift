<?php

/* (c)Bittion Admin Module | Created: 14/08/2014 | Developer:reyro */

App::uses('AppController', 'Controller');

class AdmModulesController extends AppController {

//*****************************START CONTROLLERS ********************************
////////////////////////VIEWS
//    Created: 14/08/2014 | Developer: reyro | Description: View Create 
    public function create() {
        
    }

//    Created: 14/08/2014 | Developer: reyro | Description: View Update 	
    public function update() {
        if (isset($this->passedArgs['id'])) {
            $id = $this->passedArgs['id'];
        } else {
            $this->redirect(array('action' => 'index'));
        }
        $this->AdmModule->id = $id;
        if (!$this->AdmModule->exists()) {
            $this->redirect(array('action' => 'index'));
        }
        $this->request->data = $this->AdmModule->read(null, $id);
    }

//    Created: 14/08/2014 | Developer: reyro | Description: View Index related with fnRead() 	
    public function index() {
        
    }

////////////////////////PUBLIC FUNCTIONS
//    Created: 14/08/2014 | Developer: reyro | Description: Function Create | Request: Ajax
    public function fnCreate() {
        if ($this->RequestHandler->isAjax()) {
            $response = $this->BittionMain->fnGetMethodResponse('ERROR');
            $this->request->data['data']['AdmModule']['initials'] = strtolower($this->request->data['data']['AdmModule']['initials']);
            $this->AdmModule->create();
            try {
                if ($this->AdmModule->saveAssociated($this->request->data['data'])) {
                    $response = $this->BittionMain->fnGetMethodResponse('SUCCESS');
                }
            } catch (Exception $exc) {
                $response = $this->BittionMain->fnGetExceptionResponse($exc->getCode());
            }
            return new CakeResponse(array('body' => json_encode($response)));
        } else {
            $this->redirect($this->Auth->logout()); //only accesible through ajax otherwise logout
        }
    }

//    Created: 14/08/2014 | Developer: reyro | Description: Function Update | Request: Ajax 	
    public function fnUpdate() {
        if ($this->RequestHandler->isAjax()) {
            $response = $this->BittionMain->fnGetMethodResponse('ERROR');
            $this->request->data['data'] = Set::filter($this->request->data['data']); //remove empty values
            $this->request->data['data']['AdmModule']['initials'] = strtolower($this->request->data['data']['AdmModule']['initials']);
            if ($this->request->data['data']['AdmModule']['id'] != '') { //Always send id inside $this->request->data
                try {
                    if ($this->AdmModule->save($this->request->data['data'])) {
                        $response = $this->BittionMain->fnGetMethodResponse('SUCCESS');
                    }
                } catch (Exception $exc) {
                    $response = $this->BittionMain->fnGetExceptionResponse($exc->getCode());
                }
            }
            return new CakeResponse(array('body' => json_encode($response)));
        } else {
            $this->redirect($this->Auth->logout()); //only accesible through ajax otherwise logout
        }
    }

//    Created: 14/08/2014 | Developer: reyro | Description: Function Read for DataTable | Request: Ajax 	
    public function fnRead() {
        if ($this->RequestHandler->isAjax()) {
            //Variables
            $model = 'AdmModule';
            $fields = array($model . '.id', $model . '.name', $model . '.initials', $model . '.description');
            $conditionsOR = array(
                'lower(' . $model . '.name) LIKE' => '%' . strtolower($this->request->data['sSearch']) . '%',
                'lower(' . $model . '.initials) LIKE' => '%' . strtolower($this->request->data['sSearch']) . '%',
                'lower(' . $model . '.description) LIKE' => '%' . strtolower($this->request->data['sSearch']) . '%'
            );
            $conditions = array('OR' => $conditionsOR /* ,conditions AND */);
            /////////////////////////////////////
            $this->$model->recursive = 0;
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
                $array['aaData'][$key][0] = $value[$model]['name'];
                $array['aaData'][$key][1] = $value[$model]['initials'];
                $array['aaData'][$key][2] = $value[$model]['description'];
                $array['aaData'][$key][3] = $value[$model]['id']; //for edit and delete buttons
//                $counter++;
            }
            $array['iTotalRecords'] = $total;
            $array['iTotalDisplayRecords'] = $total;
            return new CakeResponse(array('body' => json_encode($array)));
        } else {
            $this->redirect($this->Auth->logout()); //only accesible through ajax otherwise logout
        }
    }

//    Created: 14/08/2014 | Developer: reyro | Description: Function Delete| Request: Ajax 	
    public function fnDelete() {
        if ($this->RequestHandler->isAjax()) {
            $response = $this->BittionMain->fnGetMethodResponse('ERROR');
            $this->AdmModule->id = $this->request->data['id'];
            try {
                if ($this->AdmModule->delete()) {
                    $response = $this->BittionMain->fnGetMethodResponse('SUCCESS', array('content'=>'DELETE')); 
                }
            } catch (Exception $exc) {
                $response = $this->BittionMain->fnGetExceptionResponse($exc->getCode());
            }
            return new CakeResponse(array('body' => json_encode($response)));
        } else {
            $this->redirect($this->Auth->logout()); //only accesible through ajax otherwise logout
        }
    }

    //***************************** END CONTROLLERS ********************************
}
