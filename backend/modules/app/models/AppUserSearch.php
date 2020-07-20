<?php

namespace backend\modules\app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\app\models\AppUser;

/**
 * AppUserSearch represents the model behind the search form about `backend\modules\app\models\AppUser`.
 */
class AppUserSearch extends AppUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'auth_id', 'role'], 'integer'],
            [['latitude', 'longitude'], 'safe'],
            [['avatar', 'name', 'username', 'email', 'password', 'auth_key', 'password_hash', 'password_reset_token', 'description', 'content', 'gender', 'dob', 'phone', 'address', 'city', 'state', 'country', 'type', 'status', 'is_online', 'is_active', 'created_date', 'modified_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {

        //https://www.yiiframework.com/wiki/851/yii2-gridview-sorting-and-searching-with-a-junction-table-columnmany-to-many-relationship
        $query = AppUser::find()->innerJoinWith('metas', true);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['latitude'] = [
            'asc' => ['app_meta.meta_value' => SORT_ASC],
            'desc' => ['app_meta.meta_value' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['longitude'] = [
            'asc' => ['app_meta.meta_value' => SORT_ASC],
            'desc' => ['app_meta.meta_value' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'auth_id' => $this->auth_id,
            'role' => $this->role,
        ]);

        if (strlen($this->latitude) != 0) {
            $query->andFilterWhere(['AND', ['app_meta.meta_key' => 'latitude'], ['like', 'app_meta.meta_value', $this->latitude]]);
        }
        if (strlen($this->longitude) != 0) {
            $query->andFilterWhere(['AND', ['app_meta.meta_key' => 'longitude'], ['like', 'app_meta.meta_value', $this->longitude]]);
        }
        $query->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'dob', $this->dob])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'is_online', $this->is_online])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'created_date', $this->created_date])
            ->andFilterWhere(['like', 'modified_date', $this->modified_date]);

        return $dataProvider;
    }
}