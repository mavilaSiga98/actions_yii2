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

	public static function checkMobileRestriction()
	{
		$row = (new Query())
		->select(['username'])
		->from('user')
		->where(['id' => 1])
		->one();

		return $row['username'];
	}
	
	
}
