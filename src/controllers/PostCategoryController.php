<?php

namespace zacksleo\yii2\cms\controllers;

use yii\web\Controller;

class PostCategoryController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }
}
