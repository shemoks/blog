<?php

namespace backend\controllers;

use common\models\AuthItem;
use common\models\Category;
use Yii;
use common\models\Post;
use common\models\search\PostSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Post();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /** @var Category[] $categories */
            $categories = Category::find()->where(['id' => $model->category_id])->all();
            foreach ($categories as $category) {
                $model->link('category', $category);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', array(
                'model'         => $model,
                'modelCategory' => ArrayHelper::map(Category::find()->all(), 'id', 'tittle')
            ));
        }
    }


    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->category_id = ArrayHelper::getColumn($model->category, 'id');
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->main_photo = UploadedFile::getInstance($model, 'main_photo');
            $model->main_photo->name = time() . substr(strrchr($model->main_photo->name, '.'), 0);
            $model->upload();
            $model->save();
            $model->unlinkAll('category', true);
            $categories = Category::find()->where(['id' => $model->category_id])->all();
            foreach ($categories as $category) {
                    $model->link('category', $category);
            }

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model'         => $model,
                    'modelCategory' => ArrayHelper::map(Category::find()->all(), 'id', 'tittle')
                ]);
            }
        }


        /**
         * Deletes an existing Post model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public
        function actionDelete($id)
        {
            $model = $this->findModel($id);
            $model->update(['deleted_at' => time()]);
            $model->unlinkAll('category', true);
            $categories = Category::find()->where(['id' => $model->category_id])->all();
            foreach ($categories as $category) {
                $model->delete('category', $category);
            }
            return $this->redirect(['index']);
        }

        /**
         * Finds the Post model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Post the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected
        function findModel($id)
        {
            if (($model = Post::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        public
        function findPost()
        {
            return $model = Post::find();
        }
    }
