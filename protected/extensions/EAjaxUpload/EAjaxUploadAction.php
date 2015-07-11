<?php

class EAjaxUploadAction extends CAction
{

        public function run()
        {
                Yii::import("ext.EAjaxUpload.qqFileUploader");

                $allowedExtensions = array("jpg");
                $sizeLimit = 1 * 1024 * 1024;

                $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
                $result = $uploader->handleUpload('upload/eajaxupload/');
                // to pass data through iframe you will need to encode all html tags
                $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                echo $result;
        }
}
