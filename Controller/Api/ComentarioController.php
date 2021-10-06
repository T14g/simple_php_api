<?php
class ComentarioController extends BaseController
{   

    public function getIdPendencia()
    {
        $params = $this->getQueryStringParams();
        
        if($params){
            foreach($params as $p){
                $arr = explode('=', $p);
                
                if($arr[0] === 'pendencia'){
                    return $arr[1];
                }
            }
        }
        
        return null;
    }

    /**
     * @return void
     */
    public function createAction()
    {

        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'POST') {

            try {
                $comentarioModel = new ComentarioModel();

                $data = $this->getPostData();
                
                if(isset($data['id_usuario'])){
                    $idUsuario = $data['id_usuario'];
                }

                if(isset($data['usuario'])){
                    $usuario = $data['usuario'];
                }

                if(isset($data['id_pendencia'])){
                    $idPendencia = $data['id_pendencia'];
                }

                if(isset($data['content'])){
                    $comentario = $data['content'];
                }

                if(isset($data['date'])){
                    $date = $data['date'];
                }

                $response = $comentarioModel->createComentario($idUsuario, $idPendencia, $date, $usuario, $comentario);

                $responseData = json_encode($response);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }

            
        // } else {
        //     $strErrorDesc = 'Method not supported';
        //     $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        // }

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

    /**
     * "/comentario/list" Endpoint - Get list of comentarios
     */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        // $arrQueryStringParams = $this->getQueryStringParams();
        
    

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $comentarioModel = new ComentarioModel();

                $idPendencia = $this->getIdPendencia();

                $arrComentarios = $comentarioModel->getComentarios($idPendencia);

                $responseData = json_encode($arrComentarios);
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