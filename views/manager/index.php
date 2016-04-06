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
    'tableOptions' => [
        'class' => 'table table-striped',
    ],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'title',
        'alias',
        [
            'attribute' => 'created_at',
            'filter' => \kartik\daterange\DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'created_at',
                'convertFormat' => true,
                'pluginOptions' => [
                    'timePicker' => true,
                    'timePickerIncrement' => 10,
                    'locale' => [
                        'separator' => ' - ',
                        'format' => 'Y-m-d H:i'
                    ]
                ]
            ]),
            'value' => function($model) {
                /** @var Page $$model */
                return Yii::$app->formatter->asDatetime($model->created_at);
            },
        ],
        [
            'attribute' => 'updated_at',
            'filter' => \kartik\daterange\DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'updated_at',
                'convertFormat' => true,
                'pluginOptions' => [
                    'timePicker' => true,
                    'timePickerIncrement' => 10,
                    'locale' => [
                        'separator' => ' - ',
                        'format' => 'Y-m-d H:i'
                    ]
                ]
            ]),
            'value' => function($model) {
                /** @var Page $$model */
                return Yii::$app->formatter->asDatetime($model->updated_at);
            },
        ],
        [
            'attribute' => 'published',
            'filter' => Page::publishedDropDownList(),
            'value' => function($model) {
                /** @var Page $$model */
                return Yii::$app->formatter->asBoolean($model->published);
            },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => "{update}\n{delete}",
        ],
    ],
]); ?>
