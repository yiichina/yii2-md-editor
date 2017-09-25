Yii2 Markdown Editor
===================================

安装
----

安装这个扩展的首选方法是通过 [composer](http://getcomposer.org/download/)。

可以运行

```
composer require --prefer-dist yiichina/yii2-md-editor "*"
```

也可以添加

```
"yiichina/yii2-md-editor": "*"
```

到你的 `composer.json` 文件的包含部分。

安装数据库：
```
yii migrate/up --migrationPath=@vendor/yiichina/yii2-md-editor/migrations
```
在web目录创建uploads目录并给写权限：
```
mkdir -p -m 777 web/uploads
```
在config/main.php中加入以下代码：
```
'controllerMap' => [
    'attachment' => 'yiichina\mdeditor\controllers\AttachmentController',
],
```

文档和 Demo
----------

http://extension.yiichina.com/md-editor
