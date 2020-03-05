<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Campus */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Campuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="campus-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Regresar', ['/campus/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Registrar Nuevo Campus', ['/campus/create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas Seguro de Eliminar Esto?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'calle',
            'colonia',
            'numero',
            'codigoPostal',
            'telefono',
            'ciudad',
            'estado',
        ],
    ]) ?>

</div>
