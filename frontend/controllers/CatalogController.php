<?php

namespace frontend\controllers;

use backend\models\Category;
use frontend\models\Product;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\filters\VerbFilter; 
use Yii;
use common\models\PermissionHelpers;


class CatalogController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Url::remember();
            return true;
        } else {
            return false;
        }
    }


    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [   
                        'allow' => true,
                        'actions' => ['list', 'hitung'],
                        'roles' => ['?']
                    ],
                    [   
                        'allow' => true,
                        'actions' => ['list'],
                        'roles' => ['customer']
             
                    ],
                    /*[   
                        'allow' => true,
                        'actions' => ['view', 'create', 'update','delete','index'],
                        'roles' => ['member']
                    ],*/
                    [   
                        'allow' => true,
                        'actions' => [''],
                        'roles' => ['admin']
                    ],                    
                    [
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionList($id = null)
    {
        /** @var Category $category */
        $category = null;

        $categories = Category::find()->indexBy('id')->orderBy('id')->all();

        $productsQuery = Product::find();
        if ($id !== null && isset($categories[$id])) {
            $category = $categories[$id];
            $productsQuery->where(['category_id' => $this->getCategoryIds($categories, $id)]);
        }

        $productsDataProvider = new ActiveDataProvider([
            'query' => $productsQuery,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        if((Yii::$app->user->isGuest) or PermissionHelpers::requireRole('customer')){
        return $this->render('list', [
            'category' => $category,
            'menuItems' => $this->getMenuItems($categories, isset($category->id) ? $category->id : null),
            'productsDataProvider' => $productsDataProvider,
        ]);} else {
            \Yii::$app->session->addFlash('error', 'Halaman tidak ditemukan.');
        }


    }

    public function actionView()
    {
        return $this->render('view');
    }

    /**
     * @param Category[] $categories
     * @param int $activeId
     * @return array
     */
    private function getMenuItems($categories, $activeId = null)
    {
        $menuItems = [];
        foreach ($categories as $category) {
            if ($category->parent_id === null) {
                $menuItems[$category->id] = [
                    'active' => $activeId === $category->id,
                    'label' => $category->title,
                    'url' => ['catalog/list', 'id' => $category->id],
                ];
            } else {
                $this->placeCategory($category, $menuItems, $activeId);
            }
        }
        return $menuItems;
    }

    /**
     * Places category menu item into menu tree
     *
     * @param Category $category
     * @param $menuItems
     * @param int $activeId
     */
    private function placeCategory($category, &$menuItems, $activeId = null)
    {
        foreach ($menuItems as $id => $navLink) {
            if ($category->parent_id === $id) {
                $menuItems[$id]['items'][$category->id] = [
                    'active' => $activeId === $category->id,
                    'label' => $category->title,
                    'url' => ['catalog/list', 'id' => $category->id],
                ];
                break;
            } elseif (!empty($menuItems[$id]['items'])) {
                $this->placeCategory($category, $menuItems[$id]['items']);
            }
        }
    }

    /**
     * Returns IDs of category and all its sub-categories
     *
     * @param Category[] $categories all categories
     * @param int $categoryId id of category to start search with
     * @param array $categoryIds
     * @return array $categoryIds
     */
    private function getCategoryIds($categories, $categoryId, &$categoryIds = [])
    {
        foreach ($categories as $category) {
            if ($category->id == $categoryId || $category->parent_id == $categoryId) {
                $categoryIds[] = $category->id;
            }
            if (isset($categories[$categoryId]['items'])) {
                foreach ($categories[$categoryId]['items'] as $subCategoryId => $subCategory)
                $this->getCategoryIds($categories, $subCategoryId, $categoryIds);
            }
        }
        return $categoryIds;
    }
}
