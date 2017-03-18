<?php

namespace zacksleo\yii2\cms\controllers;

use yii\web\Controller;

class ItemCategoryController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }
}
