<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the registration form.
 */
class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            ['email', 'email'],
            [['username'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['password'], 'string', 'min' => 6],
            [['username'], 'unique', 'targetClass' => User::class, 'message' => 'Username telah digunakan.'],
            [['email'], 'unique', 'targetClass' => User::class, 'message' => 'Email telah digunakan.'],
        ];
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password); // Hash password saat menyimpan
            $user->role = 'customer';
            $user->create_time = date('Y-m-d H:i:s'); // Set waktu pembuatan
            $user->update_time = date('Y-m-d H:i:s'); // Set waktu update

            return $user->save(); // Simpan ke database
        }

        return false; // Jika validasi gagal
    }
    /**
     * Gets query for [[Queues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQueues()
    {
        return $this->hasMany(Queue::class, ['user_id' => 'id']);
    }
}
