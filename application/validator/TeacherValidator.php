<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\validator;

use application\core\BaseValidator;
use application\model\Teacher;
class TeacherValidator extends BaseValidator
{
    public function __construct(Teacher $teacher)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $teacher;

        //Custom Validate
        /*
        if($teacher->getPrice < $teacher->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}