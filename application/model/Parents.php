<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/

namespace application\model;

use application\core\BaseModel;
class Parents extends BaseModel
{
    public static $tableName = 'parents';
    public function __construct(\stdClass $jsonData = null, $uid = null, $isUpdate = false)
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'first_name' => self::TYPE_STRING,
            'last_name' => self::TYPE_STRING,
            'nick_name' => self::TYPE_STRING,
            'email' => self::TYPE_STRING,
            'phone' => self::TYPE_STRING,
            'occupation' => self::TYPE_STRING,
            'birth' => self::TYPE_DATE,
            'address' => self::TYPE_STRING,
            'zip_code' => self::TYPE_STRING,
            'img_file' => self::TYPE_STRING,
            'img_name' => self::TYPE_STRING,
            'std_id' => self::TYPE_INTEGER,
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'first_name' => self::TYPE_STRING,
            'last_name' => self::TYPE_STRING,
            'nick_name' => self::TYPE_STRING,
            'email' => self::TYPE_STRING,
            'phone' => self::TYPE_STRING,
            'occupation' => self::TYPE_STRING,
            'birth' => self::TYPE_DATE,
            'address' => self::TYPE_STRING,
            'zip_code' => self::TYPE_STRING,
            'img_file' => self::TYPE_STRING,
            'img_name' => self::TYPE_STRING,
            'std_id' => self::TYPE_INTEGER,
            'updated_user' => self::TYPE_INTEGER,
            'updated_at' => self::TYPE_DATE_TIME
        ));

        /* init optional field*/
        $this->setTableOptionalField(array(
            //'field_name_option',
        ));

        $this->populate($jsonData, $this, $uid, $isUpdate);
    }

    public static function getTableName()
    {
        return self::$tableName;
    }

}