<?php
/**
 * Created by PhpStorm.
 * User: cid
 * Date: 01/07/18
 * Time: 10.17
 */

namespace rahmansoft\apirestlog;
use Yii;
use yii\base\Behavior;
use yii\web\Response;
use yii\web\ResponseEvent;
use rahmansoft\apirestlog\models\ApiLog;
use yii\rest\Controller;



class Restlog extends Behavior
{
    public $app_name;
    public $UrlName;
    public $LOG_ON_ERROR = true;

    public function init()
    {
        parent::init();

        //before we send the client the response, do work
        $request = Yii::$app->request;
        $get = $request->isGet;
        $this->UrlName = $request->getUrl();
        $this->app_name = Yii::$app->id;

        Yii::$app->response->on(Response::EVENT_BEFORE_SEND, function ($event) {

            $response = $event->sender;
            $status = $response->data['status'];
            //var_dump($response->data);die();
            if ($status !== 'success') {
                if ($this->LOG_ON_ERROR) {

                    $errorName = $response->data['name'];
                    $message = $response->data['message'];
                    self::logger($this->app_name,'error-'.$errorName, $this->UrlName);
                    $json = ['status' => $status, 'Name' => $errorName, 'message' => $message];
                } else{
                    return $response->data;
                }

            } else {
                $json = $response->data;

            }
            $response1 = \GuzzleHttp\json_encode($json);
            $logid = Yii::$app->session->getFlash('apilogid');
            $this->logger_response($logid, $response1);

            //$response will have $response->statusCode etc so you can log the result here

        });
    }

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION =>'beforeAction',

        ];
    }
    public static function logger($app_name,$ws_type,$request)
    {

        $model = new ApiLog();
        $model->ipclient = self::getClientIp();
        $model->app_name = $app_name;
        $model->ws_type =$ws_type;
        $model->request = $request;
        if (isset(Yii::$app->getUser()->id)) {
            $model->createdby = Yii::$app->getUser()->id;
        } else {
            $model->createdby = 0;
        }

        $model->save(false);
        Yii::$app->session->setFlash('apilogid',$model->id);

    }
    public static function logger_response($id,$response)
    {
        $model = ApiLog::findOne(['id'=>$id]);
        $model->response = $response;
        $model->update(false);
    }



    public static function getClientIp()
    {
        $ip = false;

        $seq = array('HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR'
        , 'HTTP_X_FORWARDED'
        , 'HTTP_X_CLUSTER_CLIENT_IP'
        , 'HTTP_FORWARDED_FOR'
        , 'HTTP_FORWARDED'
        , 'REMOTE_ADDR');

        foreach ($seq as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    public function beforeAction($event)
    {
        $app_id = Yii::$app->id;
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;

        switch($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                //$params = $_REQUEST;
                $params = Yii::$app->request->get();
                $getheader = Yii::$app->request->getHeaders()->get('Authorization');
                $data[] = ['token'=>$getheader,'method'=>'GET','request'=>$params];
                $response_json = \GuzzleHttp\json_encode($data);

                $ws_type = $controller . '-' . $action;
                $this->logger($app_id,$ws_type, $response_json);
                return;
                break;
            case 'POST':
                $params = Yii::$app->request->post();
                $getheader = Yii::$app->request->getHeaders()->get('Authorization');
                $data[] = ['token'=>$getheader,'request'=>$params];
                $response_json = \GuzzleHttp\json_encode($data);

                $ws_type = $controller . '-' . $action;
                $this->logger($app_id,$ws_type, $response_json);
                return ;
                break;

        }
    }


}
