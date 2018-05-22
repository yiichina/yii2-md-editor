<?php

namespace yiichina\mdeditor\models;

use Yii;

/**
 * This is the model class for table "tbl_attachment".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $filename
 * @property integer $size
 * @property string $type
 * @property integer $downloads
 * @property integer $created_at
 */
class Attachment extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => Yii::$app->controller->action->id == 'file' ? 'zip, rar' : 'jpg, jpeg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'name' => '文件名',
            'filename' => '存储路径',
            'size' => '文件大小',
            'type' => '文件类型',
            'downloads' => '下载次数',
            'created_at' => '上传时间',
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert) {
                if(!Yii::$app->user->isGuest) {
                    $this->user_id = Yii::$app->user->id;
                }
                $this->created_at = time();
            }
            return true;
        } else {
            return false;
        }
    }
}
