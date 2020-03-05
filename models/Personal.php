<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personal".
 *
 * @property int $id
 * @property string $nombre
 * @property string $paterno
 * @property string $materno
 * @property string $fechaNacimiento
 * @property string $sexo
 * @property string $rfc
 * @property string $status
 * @property int $id_departamento
 * @property int $area_id
 *
 * @property Area $area
 * @property Departamentos $departamento
 */
class Personal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'paterno', 'materno', 'fechaNacimiento', 'sexo', 'rfc', 'status', 'id_departamento', 'area_id'], 'required'],
            [['fechaNacimiento'], 'safe'],
            [['id_departamento', 'area_id'], 'integer'],
            [['nombre'], 'string', 'max' => 200],
            [['paterno', 'materno'], 'string', 'max' => 100],
            [['sexo'], 'string', 'max' => 6],
            [['rfc'], 'string', 'max' => 13],
            [['status'], 'string', 'max' => 2],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['area_id' => 'id']],
            [['id_departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['id_departamento' => 'id']],
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
            'paterno' => 'Paterno',
            'materno' => 'Materno',
            'fechaNacimiento' => 'Fecha Nacimiento',
            'sexo' => 'Sexo',
            'rfc' => 'Rfc',
            'status' => 'Status',
            'id_departamento' => 'Id Departamento',
            'area_id' => 'Area ID',
        ];
    }

    /**
     * Gets query for [[Area]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'area_id']);
    }

    /**
     * Gets query for [[Departamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'id_departamento']);
    }
}
