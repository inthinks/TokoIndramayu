<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\dynagrid\DynaGrid;
use backend\models\User;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchCategory */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    

<?php 
     $toolbars = [
        ['content' =>
            Html::a('<i class="glyphicon glyphicon-plus"></i>', ['category/create'], ['type' => 'button', 'title' => 'Add ' . $this->title, 'class' => 'btn btn-success']) . ' ' .
            Html::a('<i class="fa fa-file-excel-o"></i>', ['category/parsing'], ['type' => 'button', 'title' => 'Parsing Excel ' . $this->title, 'class' => 'btn btn-warning']) . ' ' .
            Html::button('<i class="fa fa-download"></i>', ['type' => 'button', 'title' => 'Excel Backup ' . $this->title, 'class' => 'btn btn-default','id'=>'backupExcel']) . ' ' .
            Html::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'button', 'title' => 'Delete Selected ' . $this->title, 'class' => 'btn btn-danger', 'id' => 'deleteSelected']) . ' ' .
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['category/index','p_reset'=>true], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Reset Grid']). ' '

            
        ],
        ['content' => '{dynagridFilter}{dynagridSort}{dynagrid}'],
        '{export}',
    ];
    $panels = [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  ' . $this->title . '</h3>',
        'before' => '<div style="padding-top: 7px;"><em>* The table at the right you can pull reports & personalize</em></div>',
    ];
    $columns = [
        ['class' => 'kartik\grid\SerialColumn', 'order' => DynaGrid::ORDER_FIX_LEFT],
                    'id',
        [   'attribute' => 'parent_id',
                'value' => function ($model) {
                    return empty($model->parent_id) ? '-' : $model->parent->title;
                },
            ],
            //'user_id',
            'title',
        [
            'class' => 'kartik\grid\ActionColumn',
            'dropdown' => false,
            'vAlign' => 'middle',
            'viewOptions' => ['title' => 'view', 'data-toggle' => 'tooltip'],
            'updateOptions' => ['title' => 'update', 'data-toggle' => 'tooltip'],
            'deleteOptions' => ['title' => 'delete', 'data-toggle' => 'tooltip'],
        ],
        [
            'class' => '\kartik\grid\CheckboxColumn',
            'checkboxOptions' => [
                'class' => 'simple'
            ],
            //'pageSummary' => true,
            'rowSelectedClass' => GridView::TYPE_SUCCESS,
        ],
    ];
    
    $dynagrid = DynaGrid::begin([
                'id' => 'user-grid',
                'columns' => $columns,
                'theme' => 'panel-primary',
                'showPersonalize' => true,
                'storage' => 'db',
                //'maxPageSize' =>500,
                'allowSortSetting' => true,
                'gridOptions' => [
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'showPageSummary' => true,
                    'floatHeader' => true,
                    'pjax' => true,
                    'panel' => $panels,
                    'toolbar' => $toolbars,
                ],
                'options' => ['id' => 'Category'.Yii::$app->user->identity->id] // a unique identifier is important
    ]);

    DynaGrid::end();
?> </div>
<?php 
$this->registerJs('$(document).on("click", "#backupExcel", function(){
    var myUrl = window.location.href;
    location.href=myUrl.replace(/index/gi, "excel"); ;
});$("#deleteSelected").on("click",function(){
var array = "";
$(".simple").each(function(index){
    if($(this).prop("checked")){
        array += $(this).val()+",";
    }
})
if(array==""){
    alert("No data selected?");
} else {
    if(window.confirm("Are You Sure to delete selected data?")){
        $.ajax({
            type:"POST",
            url:"'.Yii::$app->urlManager->createUrl(['category/delete-all']).'",
            data :{pk:array},
            success:function(){
                location.href="";
            }
        });
    }
}
});');?>
