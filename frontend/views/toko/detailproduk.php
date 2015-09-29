<?php 

use yii\helpers\Html;
use yii\widgets\ListView;


?>

<div class="container">
      <div class="row">
        <div class="col-md-13">
        <div class="col-xs-5" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><center><?php echo Html::encode($toko->nama_toko);?></center></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-md-3 " align="center"> <img alt="<?= Html::encode($profile->image==null ? 'belum ada foto': $profile->image);?>" src="<?php echo $profile->getUrl();?>" class="img-circle img-responsive"> </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Pengelola</td>
                        <td><?php echo Html::encode($profile->Pengelola); ?></td>
                      </tr>
                      <tr>
                        <td>Bergabung sejak</td>
                        <td><?php echo Yii::$app->formatter->asDate($toko->date_join); ?></td>
                      </tr>
                      <tr>
                        <td>Provinsi</td>
                        <td><?php echo $profile->province_id == 0 ? '': $profile->provinsi->provinsi_nama; ?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Kota</td>
                        <td><?php echo $profile->city_id == 0 ? '': $profile->kota->kokab_nama; ?></td>
                      </tr>
                        <tr>
                        <td>Alamat Toko</td>
                        <td><?php echo Html::encode($profile->alamat); ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?php echo $user->email; ?></td>
                      </tr>
                        <td>No. Telp/HP</td>
                        <td><?php echo Html::encode($profile->phone); ?>
                        </td>
                           
                      </tr>
                      </tr>
                        <td>Deskripsi</td>
                        <td><?php echo Html::encode($profile->description); ?>
                        </td>
                           
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                 <!-- <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div> -->
            
          </div>
        </div>
        </div>
        <div class="col-md-3 col-md-3">
        <br />
        <br />
        <br />

        <br /><center><img style="width:100%" class="img-circle img-responsive" src="<?php echo $product1->getUrl();?>"</center>
        </div>     
        <div class="col-md-4 col-md-4">   
        <div class="table-responsive">
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
            <table class="table">
                    <tbody>
                      <tr>
                        <td>Nama Produk</td>  
                        <td><?php echo Html::encode($product1->title); ?></td>
                      </tr>
                      <tr>
                        <td>Deskripsi Produk</td>
                        <td><?php echo Html::encode($product1->description); ?></td>
                      </tr>
                      <tr>
                        <td>Kategori</td>
                        <td><?php echo $product1->category->title; ?></td>
                      </tr>
                         <tr>
                        <td>Harga</td>
                        <td><?php echo "Rp".number_format($product1->price, 0, '', '.').',-'; ?></td>                     
                    </tbody>
                  </table>
                  </div>
                  <center><?= Html::a('Keranjangkan', ['cart/add', 'id' => $product1->id], ['class' => 'btn btn-default navbar-btn'])?></center>
                </div>
      </div>
      <?php echo ListView::widget( [
            'dataProvider' => $productDataProvider,
            'itemView' => '_item',
        ] ); ?>
    </div>