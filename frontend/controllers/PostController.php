<?php

namespace frontend\controllers;

use common\models\AuthItem;
use common\models\Category;
use common\models\UploadForm;
use Yii;
use common\models\Post;
use common\models\search\PostSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
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
        $model->user_id = Yii::$app->user->identity->getId();
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
        $model->user_id = Yii::$app->user->identity->getId();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->unlinkAll('category', true);
            $categories = Category::find()->where(['id' => $model->category_id])->all();
            foreach ($categories as $category) {
                $model->link('category', $category);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $modelCategory = ArrayHelper::map(Category::find()->all(), 'id', 'tittle');
            return $this->render('update', [
                'model'         => $model,
                'modelCategory' => $modelCategory
            ]);
        }
    }

    public function actionUpload()
    {
        $model = new Post(); //модель куда записывать данные
        $file = new UploadForm(); //модель для обработки фото
        $file->uploadPath = substr(Post::$photoLink, 1); //константа типу  const PHOTO_LINK = '/uploads/promo-block/';
        if (!empty($_FILES['Post']['name'])) { // ['PromoSlider'] - название модели, ['name'] - название поля
            $file->imageFile = UploadedFile::getInstance($model, key($_FILES['Post']['name']));
            $file->imageFile->name = time() . substr(strrchr($file->imageFile->name, '.'), 0); //делаю название как таймштамп
            $file->upload();
        }
        return $this->respondJSON([
            'filePath' => [$file->imageFile->name],
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleted_at = time();
        $model->status = 0;
        $model->update();
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
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function findPost()
    {
        return $model = Post::find();
    }

    /**
     * @param array $data
     * @param int $code
     * @param string $statusText
     * @return array
     */
    protected function respondJSON($data = [], $code = 200, $statusText = 'OK')
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->statusCode = $code;
        Yii::$app->response->statusText = $statusText;

        return $data;
    }
}
