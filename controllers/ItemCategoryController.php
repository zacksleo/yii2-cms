<?php

namespace app\modules\console\controllers;

use yii\web\Controller;

class ItemCategoryController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }
}