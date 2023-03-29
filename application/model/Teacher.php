<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/

namespace application\model;

use application\core\BaseModel;
class Teacher extends BaseModel
{
    public static $tableName = 'teacher';
    public function __construct(\stdClass $jsonData = null, $uid = null, $isUpdate = false)
    { 
       //not use audit info 
        $this->setAuditInfo(false); 
 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'username' => self::TYPE_STRING,
            'password' => self::TYPE_STRING,
            'first_name' => self::TYPE_STRING,
            'last_name' => self::TYPE_STRING,
            'nick_name' => self::TYPE_STRING,
            'position' => self::TYPE_STRING,
            'phone' => self::TYPE_STRING,
            'room' => self::TYPE_STRING,
            'img_file' => self::TYPE_STRING,
            'img_name' => self::TYPE_STRING,
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'username' => self::TYPE_STRING,
            'password' => self::TYPE_STRING,
            'first_name' => self::TYPE_STRING,
            'last_name' => self::TYPE_STRING,
            'nick_name' => self::TYPE_STRING,
            'position' => self::TYPE_STRING,
            'phone' => self::TYPE_STRING,
            'room' => self::TYPE_STRING,
            'img_file' => self::TYPE_STRING,
            'img_name' => self::TYPE_STRING,
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