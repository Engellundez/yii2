<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campus".
 *
 * @property int $id
 * @property string $nombre
 * @property string $calle
 * @property string $colonia
 * @property string $numero
 * @property string $codigoPostal
 * @property string $telefono
 * @property string $ciudad
 * @property string $estado
 *
 * @property Departamentos[] $departamentos
 */
class Campus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'campus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'calle', 'colonia', 'numero', 'codigoPostal', 'telefono', 'ciudad', 'estado'], 'required'],
            [['nombre', 'calle', 'colonia', 'ciudad', 'estado'], 'string', 'max' => 250],
            [['numero'], 'string', 'max' => 10],
            [['codigoPostal'], 'string', 'max' => 7],
            [['telefono'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'calle' => 'Calle',
            'colonia' => 'Colonia',
            'numero' => 'Numero',
            'codigoPostal' => 'Codigo Postal',
            'telefono' => 'Telefono',
            'ciudad' => 'Ciudad',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Departamentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentos()
    {
        return $this->hasMany(Departamentos::className(), ['id_campus' => 'id']);
    }
}
