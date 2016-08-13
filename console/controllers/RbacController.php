<?php
namespace console\controllers;

use yii\console\Controller;
use Yii;


class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

        // add "view" permission
        $view = $auth->createPermission('view');
        $view->description = 'View';
        $auth->add($view);

        // add "create" permission
        $create = $auth->createPermission('create');
        $create->description = 'Create';
        $auth->add($create);

        // add "update" permission
        $update = $auth->createPermission('update');
        $update->description = 'Update';
        $auth->add($update);

        // add "delete" permission
        $delete = $auth->createPermission('delete');
        $delete->description = 'Delete';
        $auth->add($delete);

               
        // add "viewer" role and give this role the "index view" permission
        $customer = $auth->createRole('customer');
        $auth->add($customer);
        $auth->addChild($customer, $view);
        $auth->addChild($customer, $create);
        $auth->addChild($customer, $update);        
        
        // add "author" role and give this role the "create" permission
        /*$author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $create);
        $auth->addChild($author, $viewer);*/

        // add "editor" role and give this role the "edit/update" permission
        $member = $auth->createRole('member');
        $auth->add($member);/*
        $auth->addChild($editor, $update);
        $auth->addChild($editor, $create);
        //$auth->addChild($editor, $author);*/
        $auth->addChild($member, $customer);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $delete);
        /*//$auth->addChild($admin, $author);
        $auth->addChild($admin, $editor);
        */$auth->addChild($admin, $member);


        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 1);
        $auth->assign($member, 2);
        $auth->assign($customer, 3);
    }

}