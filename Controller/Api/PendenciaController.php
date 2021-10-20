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

    public function getAreaId()
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

    public function getStatus()
    {
        $params = $this->getQueryStringParams();
        
        if($params){
            foreach($params as $p){
                $arr = explode('=', $p);
                
                if($arr[0] === 'status'){
                    return $arr[1];
                }
            }
        }
        
        return null;
    }

    public function getPendenciaId()
    {
        $params = $this->getQueryStringParams();
        
        if($params){
            foreach($params as $p){
                $arr = explode('=', $p);
                
                if($arr[0] === 'id'){
                    return $arr[1];
                }
            }
        }
        
        return null;
    }

    public function updateAction(){

        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'POST') {
           $data = $this->getPostData();

           var_dump($data);
        }

    }

    public function closeAction(){

        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'POST') {

            try {
                $pendenciaModel = new PendenciaModel();

                $data = $this->getPostData();
                $date = $data['data'];
                $idPendencia = $data['id_pendencia'];
                $idUsuario = $data['id_usuario'];
                $responsavel = $data['responsavel'];
                $justificativa = $data['justificativa'];
        
                $resultUpdate = $pendenciaModel->pendenciaOK($idPendencia);
                
                if($resultUpdate){
                    $resultJustify = $pendenciaModel->createJustificativa($idUsuario, $responsavel, $idPendencia, $justificativa, $date);
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        }

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
                $areaId = $this->getAreaId();
                $status = $this->getStatus();
        
                $arrPendencias = $pendenciaModel->getPendencias($usuario, $areaId, $status, $intLimit);
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

    public function justificativaAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];


        if (strtoupper($requestMethod) == 'GET') {
            try {
                $pendenciaModel = new PendenciaModel();
                $idPendencia = $this->getPendenciaId();
                $result = $pendenciaModel->getJustificativa($idPendencia);

                $responseData = json_encode($result);
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