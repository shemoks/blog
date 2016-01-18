<?php

namespace frontend\controllers;

use common\models\Category;
use Yii;
use common\models\Post;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    //public $layout = "FrontendLayout";
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

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $model->user_id = yii::$app->user->identity->id;
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->main_photo = UploadedFile::getInstance($model, 'main_photo');
            $model->main_photo->name = time() . substr(strrchr($model->main_photo->name, '.'), 0);
            $model->upload();
            $model->save();
        }
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
