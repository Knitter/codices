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
            [['format'], 'in', 'range' => Book::formatKeys()]
        ];
    }

    /**
     * @param array $params
     * @return \yii\data\ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider {
        $query = Book::find()
            ->alias('b')
            ->where(['b.ownedById' => $this->ownerId])
            ->orderBy('b.title')
            ->joinWith(['series']);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 35],
            'sort' => false
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $provider;
        }

        $query->filterWhere([
            'b.format' => $this->format,
            'b.seriesId' => $this->series
        ])
            ->andFilterWhere(['like', 'b.title', $this->title])
            ->andFilterWhere(['like', 'b.title', $this->subTitle])
            ->andFilterWhere(['like', 'b.isbn', $this->isbn]);

        return $provider;
    }
}