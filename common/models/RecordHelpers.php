<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 23/01/2015
 * Time: 11:50 AM
 */

namespace common\models;

use yii;

class RecordHelpers {

    public static function userHas($model_name)
    {
        $connection = \Yii::$app->db;
        $userid = Yii::$app->user->identity->id;
        $sql = "SELECT id FROM $model_name WHERE user_id=:userid";
        $command = $connection->createCommand($sql);
        $command->bindValue(":userid", $userid);
        $result = $command->queryOne();
        if ($result == null) {
            return false;
        } else {
            return $result['id'];
        }
    }

}