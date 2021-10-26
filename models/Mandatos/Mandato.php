<?php

namespace app\models\Mandatos;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

class Mandato extends ActiveRecord
{

	public function rules()
	{
		return [
		
		];
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'mandatos';
	}

	public static function checkMobileRestriction($telefono, $nif_concesionario)
	{
		$currentUserProfile = (new Query())
		->select(['telefono', 'nif_concesionario'])
		->from('user_profile')
		->where(['user_id' => Yii::$app->user->id])
		->one();

		if (isset($currentUserProfile['telefono']) && is_numeric($currentUserProfile['telefono'])) {
			if ($currentUserProfile['telefono'] == $telefono && $currentUserProfile['nif_concesionario'] == $nif_concesionario) {
				return true;
			}
		}

		$limitPhone = (new Query())
		->select(['nVeces', 'isInfinite'])
		->from('limit_phone')
		->where(['telefono' => $telefono])
		->one();

		if (isset($limitPhone['isInfinite']) && $limitPhone['isInfinite']) {
			return true;
		}

		$mandatos = (new Query())
		->select(['COUNT(*) as nVeces'])
		->from('mandatos')
		->where(['telefono_mandante' => $telefono])
		->andWhere(['!=', 'estado', 'EXP_MAN'])
		->andWhere(['!=', 'estado', 'REJECT'])
		->andWhere(['!=', 'estado', 'SAVED'])
		->andWhere(['>=', 'DATE(FROM_UNIXTIME(fecha_expiracion))', date('Y-m-d')])
		->one();
		$countOfMandates = $mandatos['nVeces'];

		if (isset($limitPhone['nVeces']) && is_numeric($limitPhone['nVeces'])) {
			if ($limitPhone['nVeces'] > $countOfMandates) {
				return true;
			}
			return false;
		}

		if ($countOfMandates >= Yii::$app->params['mandatos.max_mandato_por_movil']) {
			return false;
		}

		return true;
	}
	
	
}
