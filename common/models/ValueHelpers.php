<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 23/01/2015
 * Time: 11:35 AM
 */

namespace common\models;


class ValueHelpers {

    /**
     * return the value of a role name handed in as string
     * example: 'Admin'
     *
     * @param mixed $role_name
     */
    public static function getRoleValue($role_name)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT role_value FROM role WHERE role_name=:role_name";
        $command = $connection->createCommand($sql);
        $command->bindValue(":role_name", $role_name);
        $result = $command->queryOne();

        return $result['role_value'];
    }

    /**
     * return the value of a status name handed in as string
     * example: 'Active'
     * @param mixed $status_name
     */
    public static function getStatusValue($status_name)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT status_value FROM status WHERE status_name=:status_name";
        $command = $connection->createCommand($sql);
        $command->bindValue(":status_name", $status_name);
        $result = $command->queryOne();
        return $result['status_value'];
    }

    /**
     * returns value of user_type_name so that you can
     * used in PermissionHelpers methods
     * handed in as string, example: 'Paid'
     *
     * @param mixed $user_type_name
     */
    public static function getUserTypeValue($user_type_name)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT user_type_value FROM user_type WHERE user_type_name=:user_type_name";
        $command = $connection->createCommand($sql);
        $command->bindValue(":user_type_name", $user_type_name);
        $result = $command->queryOne();
        return $result['user_type_value'];
    }


    //ambil value dari toko_id
    public static function getTokoValue($user_id)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT id FROM toko WHERE user_id=:user_id";
        $command = $connection->createCommand($sql);
        $command->bindValue(":user_id", $user_id);
        $result = $command->queryOne();

        return $result['id'];
    }

    public static function getTokoIds($user_id)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT toko_id FROM product WHERE user_id=:user_id";
        $command = $connection->createCommand($sql);
        $command->bindValue(":user_id", $user_id);
        $result = $command->queryOne();

        return $result['toko_id'];
    }

    public static function getTokoId($id)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT user_id FROM toko WHERE id=:id";
        $command = $connection->createCommand($sql);
        $command->bindValue(":id", $id);
        $result = $command->queryOne();

        return $result['user_id'];
    }

    public static function getProduct($id)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT toko_id FROM product WHERE id=:id";
        $command = $connection->createCommand($sql);
        $command->bindValue(":id", $id);
        $result = $command->queryOne();

        return $result['toko_id'];
    }

    public static function getProfile($id)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT user_id FROM product WHERE id=:id";
        $command = $connection->createCommand($sql);
        $command->bindValue(":id", $id);
        $result = $command->queryOne();

        return $result['user_id'];
    }
}