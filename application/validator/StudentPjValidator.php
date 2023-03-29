<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\validator;

use application\core\BaseValidator;
use application\model\StudentPj;
class StudentPjValidator extends BaseValidator
{
    public function __construct(StudentPj $studentPj)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $studentPj;
        $this->validateField('register_date', self::VALIDATE_DATE_TIME);
        $this->validateField('birth', self::VALIDATE_DATE);
        $this->validateField('status', self::VALIDATE_BOOLEAN);
        $this->validateField('techer_id', self::VALIDATE_INT);

        //Custom Validate
        /*
        if($studentPj->getPrice < $studentPj->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}