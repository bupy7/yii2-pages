<?php

use yii\helpers\Html;
use yii\grid\GridView;
use bupy7\pages\Module;
use bupy7\pages\models\Page;

/* @var $this yii\web\View */
/* @var $searchModel bupy7\pages\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('MODULE_NAME');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
<p>
    <?= Html::a(Module::t('CREATE'), ['create'], ['class' => 'btn btn-success']); ?>
</p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'title',
        'alias',
        [
            'attribute' => 'published',
            'filter' => Page::publishedDropDownList(),
            'value' => function($model) {
                Yii::$app->formatter->asBoolean($model->published);
            },
        ],
        'created_at:datetime',
        'updated_at:datetime',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => "{update}\n{delete}",
        ],
    ],
]); ?>
