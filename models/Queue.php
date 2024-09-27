<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "queues".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $merchant_id
 * @property int|null $service_id
 * @property int $queue_number
 * @property string|null $queue_status
 * @property string|null $created_at
 *
 * @property Merchants $merchant
 * @property Services $service
 * @property Users $user
 */
class Queue extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'queues';
    }

    public function rules()
    {
        return [
            [['queue_number', 'merchant_id', 'service_id', 'queue_status', 'user_id', 'created_at'], 'required'],
            [['user_id', 'merchant_id', 'service_id', 'queue_number'], 'integer'],
            [['queue_status'], 'string'],
            [['created_at'], 'safe'], // 'created_at' as safe for automatic timestamping
        ];
    }

    // Relasi dengan User
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    // Relasi dengan Service
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    // Relasi dengan Merchant
    public function getMerchant()
    {
        return $this->hasOne(Merchant::class, ['id' => 'merchant_id']);
    }
}