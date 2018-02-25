<?php

namespace bupy7\pages\controllers;

use yii\web\Controller;
use bupy7\pages\models\Page;
use yii\web\NotFoundHttpException;
use bupy7\pages\Module;

/**
 * View pages of module.
 *
 * @author Belosludcev Vasilij http://mihaly4.ru
 * @since 1.0.0
 */
class DefaultController extends Controller
{
    
    /**
     * View of page by alias.
     * @param string $page Alias of page.
     * @return string
     * @see Page::$alias
     */
    public function actionIndex($page)
    {
        $model = $this->findModel($page);
        return $this->render('index', [
            'model' => $model,
        ]);
    }
    
    /**
     * Finds the Page model based on alias value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $alias
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($alias)
    {
        $model = Page::find()->where([
            'alias' => $alias,
            'published' => Page::PUBLISHED_YES,
        ])->one();
        if ($model !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Module::t('PAGE_NOT_FOUND'));
    }
}
