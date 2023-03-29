<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\validator;

use application\core\BaseValidator;
use application\model\Point;
class PointValidator extends BaseValidator
{
    public function __construct(Point $point)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $point;
        $this->validateField('date', self::VALIDATE_DATE_TIME);
        $this->validateField('techer_id', self::VALIDATE_INT);
        $this->validateField('student_id', self::VALIDATE_INT);

        //Custom Validate
        /*
        if($point->getPrice < $point->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}