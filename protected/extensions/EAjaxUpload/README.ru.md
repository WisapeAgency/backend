EAjaxUpload - Данное расширение для Yii Framework позволяет загружать файлы без использования Flash
=======

## Установка

* Скачать ([zip](https://github.com/kosenka/EAjaxUpload/zipball/master), [tar.gz](https://github.com/kosenka/EAjaxUpload/tarball/master)).

* Распаковать архив в папку `application.extensions.EAjaxUpload` . Должно получиться следующее:

```
protected/
├── components/
├── controllers/
├── ... application directories
└── extensions/
    ├── EAjaxUpload/
    │   ├── assets/
    │   └── ... другие файлы расширения EAjaxUpload
    └── ... другие расширения
```

## ССылки

* [Demo](http://kosenka.ru/#tab1)
* [Extension project page](https://github.com/kosenka/EAjaxUpload)
* [Russian community discussion thread](http://yiiframework.ru/forum/viewtopic.php?f=9&t=2470)

## Использование
В представлении/шаблоне прописать так:

```php
<? $this->widget('ext.EAjaxUpload.EAjaxUpload',
                 array(
                       'id'=>'EAjaxUpload',
                       'config'=>array(
                                       'action'=>$this->createUrl('files/uploadByAjax'),
                                       'template'=>'<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',
                                       'debug'=>false,
                                       'allowedExtensions'=>array('jpg'),
                                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                       'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                                       'onComplete'=>"js:function(id, fileName, responseJSON){ alert(fileName); }",                                       
                                       //'messages'=>array(
                                       //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                       //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                       //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                       //                  'emptyError'=>"{file} is empty, please select files again without it.",
                                       //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                       //                 ),
                                       //'showMessage'=>"js:function(message){ alert(message); }"
                                      )
                      )); ?>
```

