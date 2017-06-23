<?php

namespace app\modules\menu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\menu\models\MenuItems;

/**
 * MenuItemsSearch represents the model behind the search form of `app\modules\menu\models\MenuItems`.
 */
class MenuItemsSearch extends MenuItems {
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id', 'pos', 'pid'], 'integer'],
			[['menu', 'title', 'link'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios() {
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = MenuItems::find();

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}
		
		// $this->menu = 'main';
		// grid filtering conditions
		$query->andFilterWhere([
			'id' => $this->id,
			'pos' => $this->pos,
			'pid' => $this->pid,
		]);

		$query->andFilterWhere(['like', 'menu', $this->menu])
			->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'link', $this->link]);

		return $dataProvider;
	}
}
