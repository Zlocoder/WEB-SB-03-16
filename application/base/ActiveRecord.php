<?php

namespace app\base;


class ActiveRecord extends \yii\db\ActiveRecord
{
    public function init()
    {
        $this->attachBehavior('timestamp', [
            'class' => 'yii\behaviors\TimestampBehavior',
            'createdAtAttribute' => 'createdAt',
            'updatedAtAttribute' => 'updatedAt',
            'value' => new \yii\db\Expression('NOW()')
        ]);
    }
}