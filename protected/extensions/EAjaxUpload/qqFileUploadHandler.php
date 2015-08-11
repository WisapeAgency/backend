<?php
/**
 * Fine uploader handlers.
 *
 * @author Vladimir Papaev <kosenka@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * Fine uploader upload handler.
 *
 * @author Filios Konstantinos <konfilios@gmail.com>
 * @author Vladimir Papaev <kosenka@gmail.com>
 */
class qqFileUploadHandler
{
    /**
     * Allowed file extensions.
     * @var string[]
     */
    private $allowedExtensions = array();
    /**
     * Maximum file size limit.
     * @var integer
     */
    private $sizeLimit = 10485760;

    /**
     * Uploaded file instance
     * @var qqUploadedFileXhr
     */
    private $uploadedFile;

    /**
     * Set allowed file extensions.
     *
     * @param array $allowedExtensions
     * @return qqFileUploader
     */
    public function setAllowedExtensions(array $allowedExtensions = array())
    {
        $allowedExtensions = array_map("strtolower", $allowedExtensions);

        $this->allowedExtensions = $allowedExtensions;

        return $this;
    }

    /**
     * Set maximum file size in bytes.
     * @param integer $sizeLimit
     * @param boolen $doValidateAgainstServerSettings
     * @return qqFileUploader
     */
    public function setSizeLimit($sizeLimit = 10485760, $doValidateAgainstServerSettings = true)
    {
        $this->sizeLimit = $sizeLimit;

        if ($doValidateAgainstServerSettings) {
            $this->checkMaxSizeLimitServerSettings();
        }
        return $this;
    }

    /**
     * Make sure user-defined size limit does not violate php.ini settings.
     */
    private function checkMaxSizeLimitServerSettings()
    {
        $postSize = $this->phpIniValueToBytes(ini_get('post_max_size'));
        $uploadSize = $this->phpIniValueToBytes(ini_get('upload_max_filesize'));

        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit) {
            $size = max(1, $this->sizeLimit / 1024 / 1024).'M';
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");
        }
    }

    /**
     * Convert php.ini setting size value to integer.
     * @param string $phpIniSetting
     * @return integer
     */
    private function phpIniValueToBytes($phpIniSetting)
    {
        $byteValue = trim($phpIniSetting);
        $unit = strtolower($phpIniSetting[strlen($phpIniSetting) - 1]);
        switch ($unit) {
            case 'g': $byteValue *= 1024;
            case 'm': $byteValue *= 1024;
            case 'k': $byteValue *= 1024;
        }
        return $byteValue;
    }

    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = false,$isCut = false)
    {
        if (!is_writable($uploadDirectory)) {
            return array('error' => "Server error. Upload directory isn't writable.");
        }
        if (isset($_GET['qqfile'])) {
            $this->uploadedFile = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->uploadedFile = new qqUploadedFileForm();
        } else {
            $this->uploadedFile = false;
            return array('error' => 'No files were uploaded.');
        }

        $size = $this->uploadedFile->getSize();

        if ($size == 0) {
            return array('error' => 'File is empty');
        }

        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }

        $pathinfo = pathinfo($this->uploadedFile->getName());
//        $filename = $pathinfo['filename'];
        $filename = md5(uniqid());
        $ext = $pathinfo['extension'];

        if ($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)) {
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '.$these.'.');
        }

        if (!$replaceOldFile) {
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory.$filename.'.'.$ext)) {
                $filename .= rand(10, 99);
            }
        }
        $m = date('YmdH').'/';
        if($isCut){
            if($this->uploadedFile->save($uploadDirectory.$filename.'.'.$ext,$uploadDirectory.$filename.'_s.'.$ext,$ext)){
                return array('success' => true, 'filename' => SITE_URL.'uploads/'.$m.$filename.'.'.$ext);
            }else{
                return array('error' => 'Could not save uploaded file.'.
                    'The upload was cancelled, or server error encountered');
            }
        }else{
            if ($this->uploadedFile->save($uploadDirectory.$filename.'.'.$ext)) {
                return array('success' => true, 'filename' => SITE_URL.'uploads/'.$m.$filename.'.'.$ext);
            } else {
                return array('error' => 'Could not save uploaded file.'.
                    'The upload was cancelled, or server error encountered');
            }
        }
    }

}

/**
 * Handle file uploads via XMLHttpRequest
 *
 * This is a "private" class. It's only used internally by qqFileUploader
 *
 * @author Vladimir Papaev <kosenka@gmail.com>
 */
class qqUploadedFileXhr
{
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path)
    {
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);

        if ($realSize != $this->getSize()) {
            return false;
        }

        $target = fopen($path, "w");
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);

        return true;
    }

    function getName()
    {
        return $_GET['qqfile'];
    }

    function getSize()
    {
        if (isset($_SERVER["CONTENT_LENGTH"])) {
            return (int) $_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
    }

}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 *
 * This is a "private" class. It's only used internally by qqFileUploader
 *
 * @author Vladimir Papaev <kosenka@gmail.com>
 */
class qqUploadedFileForm
{
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path,$spath='',$type='')
    {
        if (!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)) {
            return false;
        }
        if(@copy($path,$spath)){
            $this->upimg($spath,160,285,$type);
        }
        //这里需要切个小图
        return true;
    }

    function getName()
    {
        return $_FILES['qqfile']['name'];
    }

    function getSize()
    {
        return $_FILES['qqfile']['size'];
    }


    /**
     * $imgval 获取文件
     * $newwidth 生成缩略图宽度
     * $newheight 生成缩略图高度
     * $typeval 图片类型
     **/
    function upimg($imgval,$newwidth,$newheight,$typeval){
        $img=$imgval;//$sdir.$filename;//获取该图片
        $type=$typeval;//获取文件类型
        list($width,$height)=getimagesize($img);//获取该图片大小
        $newimg=imagecreatetruecolor($newwidth,$newheight);
        if($type=="gif" || $type=="GIF"){
            $source=imagecreatefromgif($img);
        }
        else if($type=="jpg" || $type=="JPG" || $type=="jpeg" || $type=="JPEG"){
            $source=imagecreatefromjpeg($img);
        }
        else if($type=="png" || $type=="PNG"){
            $source=imagecreatefrompng($img);
        }
        imagecopyresampled($newimg,$source,0,0,0,0,$newwidth,$newheight,$width,$height);

        if($type=="gif" || $type=="GIF"){
            imagegif($newimg);
        }
        else if($type=="jpg" || $type=="JPG" || $type=="jpeg" || $type=="JPEG"){
            imagejpeg($newimg,$img);
        }
        else if($type=="png" || $type=="PNG"){
            imagepng($newimg,$img);
        }
    }

}