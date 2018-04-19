<?php

class UploadFileHelper {

    public static $TARGET_DIR = "\\MvcProjectTemplate\\uploads\\";
    public static $IMAGES_EXTENSION = "jpeg|jpg|bmp|png|gif";

    public static function processUploadFile() {
        self::$TARGET_DIR = $_SERVER['DOCUMENT_ROOT'] . self::$TARGET_DIR;
        $target_file = UploadFileHelper::$TARGET_DIR . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if (strpos(UploadFileHelper::$IMAGES_EXTENSION, $imageFileType) < 0) {
            throw new Exception("Invalid images file");
        }
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            throw new Exception("File size is large");
        }
        $results = array();
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $results["FileName"] = basename($_FILES["fileToUpload"]["name"]);
            echo "file in" . basename($_FILES["fileToUpload"]["name"]);
        } else {
            throw new Exception("Error in processing uploaded file");
        }

        return $results;
    }

}
