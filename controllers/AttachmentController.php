<?php

namespace yiichina\mdeditor\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\Url;
use yiichina\mdeditor\Image;
use yiichina\mdeditor\models\Attachment;

/**
 * AttachmentController implements the CRUD actions for Attachment model.
 */
class AttachmentController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['file', 'image', 'delete'],
                'rules' => [
                    [
                        'actions' => ['file', 'image'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    public function init()
    {
        parent::init();
        $this->setViewPath('@vendor/yiichina/yii2-md-editor/views/attachment');
    }

    public function actionFile()
    {
        $model = new Attachment();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {               
                $month = date('Ym');
                $model->name = $model->file->name;
                $model->size = $model->file->size;
                $model->type = $model->file->type;
                $model->is_file = true;
                $path = Yii::getAlias('@webroot/uploads/files/');

                if(!is_dir($path . $month . '/')) {
                    mkdir($path . $month . '/', 0755);
                }

                $basename = date('dHis') . rand(100, 999);
                $filename = $month . '/' . $basename . '.' . $model->file->extension;

                $model->filename = $filename;

                if($model->file->saveAs($path . $filename)) {
                    if($model->save(false)) {
                        $url = Url::to(['attachment/download', 'id' => $model->id]);
                        $thumbnailUrl = Yii::getAlias('@web') . '/images/logo.png'; 
                        $deleteUrl = Url::to(['attachment/delete', 'id' => $model->id]);
                        echo Json::encode(['files' => [['name' => $model->name, 'size' => $model->size, 'url' => $url, 'thumbnailUrl' => $thumbnailUrl, 'deleteUrl' => $deleteUrl, 'deleteType' => 'DELETE']]]);
                    }
                    Yii::$app->end();
                }
            } else {
                echo Json::encode(['files' => [['name' => $model->file->name, 'size' => $model->file->size, 'type' => $model->file->type, 'error' => array_values(array_values($model->errors))]]]);
                Yii::$app->end();
            }
        } else {
            $history = Attachment::find()->where(['user_id' => Yii::$app->user->id, 'is_file' => true])->orderBy('id DESC')->limit(10)->all();
        }

        return $this->renderAjax('file', [
            'model' => $model,
            'history' => $history,
        ]);
    }

    public function actionImage()
    {
        $model = new Attachment();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                $month = date('Ym');
                $model->name = $model->file->name;
                $model->size = $model->file->size;
                $model->type = $model->file->type;
                $path = Yii::getAlias('@webroot/uploads/images/');

                if(!is_dir($path . $month . '/')) {
                    mkdir($path . $month . '/', 0755);
                }

                $basename = date('dHis') . rand(100, 999);
                $filename = $month . '/' . $basename . '.' . $model->file->extension;
                $thumbnail = $month . '/' . $basename . '_thumb.' . $model->file->extension;

                $model->filename = $filename;

                if($model->file->saveAs($path . $filename)) {
                    Image::thumbnail($path . $filename, 500, 500, 'inset')->save($path . $thumbnail, ['quality' => 100]);
                    if($model->save(false)) {
                        $url = Yii::getAlias('@web') . '/uploads/images/' . $filename;
                        $thumbnailUrl = Yii::getAlias('@web') . '/uploads/images/' . rtrim($filename, '.' . $model->file->extension) . '_thumb.' . $model->file->extension;
                        $deleteUrl = Url::to(['attachment/delete', 'id' => $model->id]);
                        echo Json::encode(['files' => [['name' => $model->name, 'size' => $model->size, 'url' => $url, 'thumbnailUrl' => $thumbnailUrl, 'deleteUrl' => $deleteUrl, 'deleteType' => 'DELETE']]]);
                    }
                    Yii::$app->end();
                }
            } else {
                echo Json::encode(['files' => [['name' => $model->file->name, 'size' => $model->file->size, 'type' => $model->file->type, 'error' => array_values(array_values($model->errors))]]]);
                Yii::$app->end();
            }
        } else {
            $history = Attachment::find()->where(['user_id' => Yii::$app->user->id, 'is_file' => false])->orderBy('id DESC')->limit(10)->all();
        }
        return $this->renderAjax('image', [
            'model' => $model,
            'history' => $history,
        ]);
    }

    public function actionDownload($id)
    {
        $model = Attachment::findOne($id);
        $model->updateCounters(['downloads' => 1]);
        Yii::$app->response->sendFile(Yii::getAlias('@webroot/uploads/attachment/' . $model->filename), $model->name);
    }

    /**
     * Deletes an existing Attachment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->is_file) {
            @unlink(Yii::getAlias('@webroot') . '/uploads/files/' . $model->filename);
        } else {
            $filename = pathinfo($model->filename);
            @unlink(Yii::getAlias('@webroot') . '/uploads/images/' . $model->filename);
            @unlink(Yii::getAlias('@webroot/uploads/images/' . rtrim($model->filename, '.' . $filename['extension']) . '_thumb.' . $filename['extension']));
        }
        $model->delete();
        echo Json::encode([$model->name => true]);
    }

    /**
     * Finds the Attachment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attachment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attachment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
