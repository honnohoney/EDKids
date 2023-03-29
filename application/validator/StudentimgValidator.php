<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\validator;

use application\core\BaseValidator;
use application\model\Studentimg;
class StudentimgValidator extends BaseValidator
{
    public function __construct(Studentimg $studentimg)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $studentimg;
        $this->validateField('student_id', self::VALIDATE_REQUIRED);
        $this->validateField('student_id', self::VALIDATE_INT);
        $this->validateField('image_name', self::VALIDATE_REQUIRED);
        $this->validateField('upload_user', self::VALIDATE_REQUIRED);
        $this->validateField('upload_user', self::VALIDATE_INT);
        $this->validateField('upload_data', self::VALIDATE_REQUIRED);
        $this->validateField('upload_data', self::VALIDATE_DATE_TIME);

        //Custom Validate
        /*
        if($studentimg->getPrice < $studentimg->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}