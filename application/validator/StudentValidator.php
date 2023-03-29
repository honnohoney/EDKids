<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\validator;

use application\core\BaseValidator;
use application\model\Student;
class StudentValidator extends BaseValidator
{
    public function __construct(Student $student)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $student;
        $this->validateField('register_date', self::VALIDATE_DATE_TIME);
        $this->validateField('birth', self::VALIDATE_DATE);
        $this->validateField('status', self::VALIDATE_BOOLEAN);
        $this->validateField('techer_id', self::VALIDATE_INT);

        //Custom Validate
        /*
        if($student->getPrice < $student->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}