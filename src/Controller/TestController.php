<?php
declare(strict_types=1);

namespace JSNLog\Controller;

use JSNLog\Controller\AppController;

/**
 * Catch Controller
 *
 * @method \JSNLog\Model\Entity\Catch[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TestController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        
          
        $response = $this->response;
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');
        
    }



    
}