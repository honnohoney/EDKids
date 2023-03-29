<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/

namespace application\model;

use application\core\BaseModel;
class Social extends BaseModel
{
    public static $tableName = 'social';
    public function __construct(\stdClass $jsonData = null, $uid = null, $isUpdate = false)
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'upload_time' => self::TYPE_DATE_TIME,
            'msg' => self::TYPE_STRING,
            'techer_id' => self::TYPE_INTEGER,
            'image_id' => self::TYPE_INTEGER,
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'upload_time' => self::TYPE_DATE_TIME,
            'msg' => self::TYPE_STRING,
            'techer_id' => self::TYPE_INTEGER,
            'image_id' => self::TYPE_INTEGER,
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