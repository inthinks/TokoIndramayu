<?php

namespace frontend\models;

use Yii;
// use frontend\models\Toko;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\behaviors\SluggableBehavior;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;
use yii\web\UploadedFile;
use frontend\models\Category;
/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $price
 * @property integer $category_id
 * @property integer $stock
 */
class Product extends \yii\db\ActiveRecord implements CartPositionInterface
{
    use CartPositionTrait;
    public static $imagePath = '@webroot/produk/';

    // public $images;

        // public static $imagePath = '@webroot/product/image';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /*public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAtrribute' => 'title'
            ]
        ];
    }*/

    public function behaviors()
    {
        return [
            'image' => [
                'class' => \common\models\CropBehavior::className(),
                'paths' => self::$imagePath,
                'width' => 200,
                'height' => 200
            ],
            //TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','image','description', 'price', 'category_id'], 'required'],
            [['description'], 'string'],
            [['price'], 'string', 'max' => 50],
            [['image'], 'file', 'skipOnEmpty'=> false, 'extensions' => 'png,jpg'],
            [['category_id', 'toko_id'], 'integer'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    public function afterFind(){
        parent::afterFind();
        $this->price = $this->convert_to_number($this->price);
        return true;
    }
        public function beforeSave(){
            parent::afterFind();
            $this->price = $this->convert_to_number($this->price);
            return true;
    }

    public function convert_to_number($rupiah)
    {
        return intval(preg_replace('/,.*|[^0-9]/', '', $rupiah));
    }
    
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title'  => 'Nama Produk',
            'description' => Yii::t('app', 'Deskripsi'),
            'price' => Yii::t('app', 'Harga'),
            'category_id' => Yii::t('app', 'Kategori'),
            //'stock' => Yii::t('app', 'Sisa'),
            'toko_id' => Yii::t('app', 'Toko'),
        ];
    }

    /*public function getImages()
    {
        return $this->hasOne(Image::className(), ['product_id' => 'id']);
    }*/

    /*public function getImages()
    {
        return $this->image;
    }*/

    public function getToko()
    {
        return $this->hasOne(Toko::className(), ['toko_id' => 'id']);
    }

     public function getTokoId()
    {
        return $this->toko ? $this->toko->id : 'none';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

     public function getCategoryId()
    {
        return $this->category ? $this->category->id : 'none';
    }

    public static function getCategoryList()
    {
        $cate = new Category;
        $droptions = $cate::find()->where(['not',['parent_id' => null]])->all();
        return ArrayHelper::map($droptions, 'id' ,'title');
    }

    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }



    protected function getHash()
    {
        // return md5($this->product_id . '-' . $this->id);
        return md5($this->image);
    }

    /**
     * @return string path to image file
     */
    public function getPath()
    {
        return Yii::getAlias('@frontend/web/produk/' . $this->getHash() . '.jpg');
    }

    /**
     * @return string URL of the image
     */
    public function getUrl()
    {
        return Yii::getAlias('@frontendWebroot/produk/image/' .Html::encode($this->image));
    }

    /*public function afterDelete()
    {
        unlink($this->getUrl());
        parent::afterDelete();
    }*/


    public function upload()
    {
        if ($this->validate()) {
            $file = UploadedFile::getInstance($this, 'image');
            /*if($this->save(false))
            {*/
                if(!empty($file)){
            
            $file->saveAs(Yii::$app->basePath.'/web/produk/' . $file->baseName .'.'.  $file->extension);
            \yii\imagine\Image::thumbnail(Yii::$app->basePath.'/web/produk/' . $this->image,150,150)
            ->save(Yii::$app->basePath.'/web/produk/image/' . $this->image);
 
                }
            //}

            // $this->image->saveAs(\Yii::$app->basePath . DIRECTORY_SEPARATOR.'/web/produk/'.$file->baseName.'.'.$file->extension);
            return true;
        } else {
            return false;
        }
    }

    public function getlink($images)
    {
        return Yii::getAlias('@frontendWebroot/images/'.$images.'.jpg');
    }

    public function getOrderDetail()
    {
        return $this->hasMany(OrderDetail::className(), ['product_id' => 'id']);
    }


    public function getImageTrue() {
        $image = $this->image;
        $pos = strpos($image, "http");
        if ($pos !== FALSE) {
            return $this->image;
        } else {
            return Yii::getAlias($this->image);
        }
    }

     public function getThumbnailTrue() {
        $image = $this->image;
        $pos = strpos($image, "http");
        if ($pos !== FALSE) {
            return $this->image;
        } else {
            if ($image) {
                $name = \yii\helpers\StringHelper::basename($image);
                $dir = \yii\helpers\StringHelper::dirname($image);
                return Yii::getAlias('@frontendWebroot/produk/' .$this->image);
            } else {
                return Yii::$app->request->baseUrl . '/img/photo.jpg.png';
            }
        }
    }

    public function getAvatarTrue() {
        return $this->thumbnailTrue;
    }

    public function getAvatarImage() {
        return $this->thumbnailTrue;
    }

    public function getThumb() {
        if ($this->thumbnailTrue) {
            return \yii\helpers\Html::img($this->thumbnailTrue, ['width' => '100px']);
        } else
            return \yii\helpers\Html::img(Yii::getAlias('@frontendWebroot/produk/' .$this->image), ['width' => '100px']);
    }
}
