<?php
declare(strict_types=1);

namespace JSNLog\Controller;

use JSNLog\Controller\AppController;

/**
 * Catch Controller
 *
 * @method \JSNLog\Model\Entity\Catch[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CatchController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        print_r(json_decode(file_get_contents('php://input')));

        
        $this->request->allowMethod(['post', 'delete']);
        $response = $this->response;
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');

        exit;

    }


private function get_error_data($jslog_input){
    $msg = "failure - no JSNLog messages found in request";

    if (is_array($jslog_input) && array_key_exists("lg",$jslog_input)) {
        $msg="success";
        $JLKeys = parse_ini_file("jsnlog.ini.php",true);
        $log_options = array(0,'','');
        if (is_array($JLKeys) && array_key_exists('server',$JLKeys)) {
            foreach($JLKeys['server'] as $key => $item) {
                switch($key) {
                    case "msg_type":
                        $log_options[0] = $item;
                        break;
                    case "destination":
                        $log_options[1] = $item;
                        break;
                    case "extra_headers":
                        $log_options[2] = $item;
                        break;
                }
            }
        }
            foreach($jslog_input["lg"] as $msgItem) {
            $jslog_msg = $msgItem["m"];
            $log_result = error_log("[JSPHPLog]: $jslog_msg" . "\n", $log_options[0], $log_options[1], $log_options[2]);
        }
        if (!$log_result) $msg="failure - problem writing to error_log";	
    }
    echo(json_encode(array('result',$msg)));// return a success/fail message;


    
}
    
}

/**
 * 
 * 
 * stdClass Object
(
    [r] => 
    [lg] => Array
        (
            [0] => stdClass Object
                (
                    [l] => 6000
                    [m] => {"stack":"Error: Exception message\n    at http://localhost:8765/jsnlog.logger/test:33:7","message":"Exception message","name":"Error","logData":{"msg":"Uncaught Exception","errorMsg":"Uncaught Error: Exception message","url":"http://localhost:8765/jsnlog.logger/test","line number":33,"column":7}}
                    [n] => onerrorLogger
                    [t] => 1612489190900
                    [u] => 1
                )

        )

)
 */