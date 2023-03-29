<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/

namespace application\model;

use application\core\BaseModel;
class Student extends BaseModel
{
    public static $tableName = 'student';
    public function __construct(\stdClass $jsonData = null, $uid = null, $isUpdate = false)
    { 
       //not use audit info 
        $this->setAuditInfo(false); 
 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'special' => self::TYPE_STRING,
            'first_name' => self::TYPE_STRING,
            'last_name' => self::TYPE_STRING,
            'nick_name' => self::TYPE_STRING,
            'register_date' => self::TYPE_DATE_TIME,
            'birth' => self::TYPE_DATE,
            'img_name' => self::TYPE_STRING,
            'img_file' => self::TYPE_STRING,
            'status' => self::TYPE_BOOLEAN,
            'techer_id' => self::TYPE_INTEGER,
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'special' => self::TYPE_STRING,
            'first_name' => self::TYPE_STRING,
            'last_name' => self::TYPE_STRING,
            'nick_name' => self::TYPE_STRING,
            'register_date' => self::TYPE_DATE_TIME,
            'birth' => self::TYPE_DATE,
            'img_name' => self::TYPE_STRING,
            'img_file' => self::TYPE_STRING,
            'status' => self::TYPE_BOOLEAN,
            'techer_id' => self::TYPE_INTEGER,
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