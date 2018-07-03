<?php

namespace Rahmansoft\Apirestlog\models;
use Yii;


/**
 * This is the model class for table "api_log".
 *
 * @property int $id
 * @property string $ipclient
 * @property string $ws_type
 * @property string $request
 * @property string $response
 * @property string $create_date
 */
class ApiLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'api_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request', 'response'], 'string'],
            [['create_date'], 'safe'],
            [['ipclient'], 'string', 'max' => 32],
            [['app_name','ws_type'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Log ID',
            'ipclient' => 'Ipclient',
            'app_name' => 'app name',
            'ws_type' => 'Ws Type',
            'request' => 'Request',
            'response' => 'Response',
            'create_date' => 'Create Date',
        ];
    }
}
