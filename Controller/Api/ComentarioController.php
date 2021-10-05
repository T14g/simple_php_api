<?php
class ComentarioController extends BaseController
{
    /**
     * @return int $limit
     */

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