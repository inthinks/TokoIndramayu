<?php


namespace common\models;

    use frontend\models\Toko;
    use frontend\models\Category;
        
        class helper
        {
          const DATE_FORMAT = 'php:Y-m-d';
          const DATETIME_FORMAT = 'php:Y-m-d H:i:s';
          const TIME_FORMAT = 'php:H:i:s';
 
          public static function convert($dateStr, $type = 'date', $format = null) {
          if ($type === 'datetime') {
                $fmt = ($format == null) ? self::DATETIME_FORMAT : $format;
            } elseif ($type === 'time') {
                $fmt = ($format == null) ? self::TIME_FORMAT : $format;
            } else {
                $fmt = ($format == null) ? self::DATE_FORMAT : $format;
            }
            return \Yii::$app->formatter->asDate($dateStr, $fmt);
        }
    
            public static function item(){
    
           $toko = Toko::find()
              ->orderBy('nama_toko')
              ->all();
           /*$category = category::find()
              ->orderBy('Category_name')
              ->all();*/
            

           $menuItems = [];
           // $menuItems2 = [];
           /*foreach ($Category as $key => $value) {
              $menuItems[] = [
                                'label' => $Category->Category_name,
                                 'icon'=>'info-sign',
                                  'url'=>'#';
                                  // 'items' => ;*/
            foreach ($toko as $key => $value0) {
                $menuItems[] =
                                  [
                                    'label'=> $value0->nama_toko,
                                     'icon'=>'home',
                                      'url'=>['toko/index', 'id' => $value0->id],
                                      //'items' => $menuItems,
                                        
                                        ];
                                    
                                
                          
                          
                    
                  }         
                
                 // $menuItems = [];
                 // $nested2 = [];
                // $nested1 = [];
/*foreach ($category as $key => $value) {
$nested2[] = [
'label' => $value->Category_name,
'icon'=>'info-sign',
'url'=>'#'
// 'items' =>
];
}*//*
foreach ($toko as $key => $value0) {
$nested1[] =>[
'label' => $value0->nama_toko,
'icon'=>'home',
'url'=>'#',
// 'items' => $nested2
];
}
$menuItems[] =$nested1;
*/
          return $menuItems;   
           // parent::init();
        }
      }


