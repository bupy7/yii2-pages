<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model bupy7\pages\models\Page */

if (empty($model->title_browser)) {
    $this->title = $model->title;
} else {
    $this->title = $model->title_browser;
}
if (!empty($model->meta_description)) {
    $this->registerMetaTag(['content' => Html::encode($model->meta_description), 'name' => 'description']);
}
if (!empty($model->meta_keywords)) {
    $this->registerMetaTag(['content' => Html::encode($model->meta_keywords), 'name' => 'keywords']);
}
?>
<div class="page-header">
    <h1><?= Html::encode($model->title); ?></h1>
</div>
<div class="clearfix"></div>
<?= $model->content; ?>
