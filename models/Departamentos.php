<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamentos".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $telefono
 * @property int $id_campus
 *
 * @property Campus $campus
 * @property Personal[] $personals
 */
class Departamentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departamentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'telefono', 'id_campus'], 'required'],
            [['id_campus'], 'integer'],
            [['nombre', 'descripcion'], 'string', 'max' => 250],
            [['telefono'], 'string', 'max' => 12],
            [['id_campus'], 'exist', 'skipOnError' => true, 'targetClass' => Campus::className(), 'targetAttribute' => ['id_campus' => 'id']],
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
            'descripcion' => 'Descripcion',
            'telefono' => 'Telefono',
            'id_campus' => 'Id Campus',
        ];
    }

    /**
     * Gets query for [[Campus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCampus()
    {
        return $this->hasOne(Campus::className(), ['id' => 'id_campus']);
    }

    /**
     * Gets query for [[Personals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonals()
    {
        return $this->hasMany(Personal::className(), ['id_departamento' => 'id']);
    }
}
