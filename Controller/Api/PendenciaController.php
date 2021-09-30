<?php
class PendenciaController extends BaseController
{
    /**
     * @return int $limit
     */

    public function getLimit()
    {
        $params = $this->getQueryStringParams();
        
        if($params){
            foreach($params as $p){
                $arr = explode('=', $p);
                
                if($arr[0] === 'limit'){
                    return $arr[1];
                }
            }
        }

        return null;
    }

    public function getUsuario()
    {
        $params = $this->getQueryStringParams();
        
        if($params){
            foreach($params as $p){
                $arr = explode('=', $p);
                
                if($arr[0] === 'usuario'){
                    return $arr[1];
                }
            }
        }
        
        return null;
    }

    public function getSetor()
    {
        $params = $this->getQueryStringParams();
        
        if($params){
            foreach($params as $p){
                $arr = explode('=', $p);
                
                if($arr[0] === 'setor'){
                    return $arr[1];
                }
            }
        }
        
        return null;
    }
    
    /**
     * "/pendencia/list" Endpoint - Get list of pendencias
     */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        // $arrQueryStringParams = $this->getQueryStringParams();
        
    

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $pendenciaModel = new PendenciaModel();

                $intLimit = $this->getLimit();
                $usuario = $this->getUsuario();
                $setor = $this->getSetor();
        
                $arrPendencias = $pendenciaModel->getPendencias($usuario, $setor, $intLimit);
                $responseData = json_encode($arrPendencias);
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