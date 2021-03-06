<?php

namespace lav45\behaviors\tests\models;

use yii\db\ActiveRecord;

/**
 * Class PushModel
 * @package lav45\behaviors\tests\models
 *
 * @property int $id
 * @property string $username
 */
class PushModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'push_model';
    }
}