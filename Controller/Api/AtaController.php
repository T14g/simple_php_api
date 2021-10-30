<?php
class AtaController extends BaseController
{
    public function getArea()
    {
        $params = $this->getQueryStringParams();
        
        if($params){
            foreach($params as $p){
                $arr = explode('=', $p);
                
                if($arr[0] === 'area'){
                    return $arr[1];
                }
            }
        }
        
        return null;
    }
    /**
     * @return []
     */
    public function lastAction()
    {   
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $area = $this->getArea();
                $ataModel = new AtaModel();
                $last = $ataModel->getLastAtaFromArea($area);
                $responseData = json_encode($last);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}