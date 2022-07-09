<?php

namespace codices\filters;

use common\models\Book;
use yii\base\Model;
use yii\data\ActiveDataProvider;

final class Books extends Model {

    private int $ownerId;
    public ?string $title = null;
    public ?string $subTitle = null;
    public ?string $isbn = null;
    public ?string $format = null;
    public ?string $digital = null;
    public ?string $series = null;

    /**
     * @param int   $ownerId
     * @param array $config
     */
    public function __construct(int $ownerId, array $config = []) {
        $this->ownerId = $ownerId;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules(): array {
        return [
            [['title', 'subTitle', 'isbn'], 'string'],
            [['series'], 'integer'],
            [['format'], 'in', 'range' => Book::formatKeys()],
            [['digital'], 'in', 'range' => ['yes', 'no']],
        ];
    }

    /**
     * @param array $params
     * @return \yii\data\ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider {
        $query = Book::find()
            ->where(['ownedById' => $this->ownerId])
            ->orderBy('title')
            ->joinWith(['series']);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 35],
            'sort' => false
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $provider;
        }

        $query->filterWhere(['format' => $this->format, 'series' => $this->series])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title', $this->subTitle])
            ->andFilterWhere(['like', 'isbn', $this->isbn]);

        if (!empty($this->digital)) {
            $query->andWhere(['digital' => $this->digital == 'yes']);
        }

        return $provider;
    }
}