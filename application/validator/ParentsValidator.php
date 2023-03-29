<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\validator;

use application\core\BaseValidator;
use application\model\Parents;
class ParentsValidator extends BaseValidator
{
    public function __construct(Parents $parents)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $parents;
        $this->validateField('birth', self::VALIDATE_DATE);
        $this->validateField('std_id', self::VALIDATE_REQUIRED);
        $this->validateField('std_id', self::VALIDATE_INT);

        //Custom Validate
        /*
        if($parents->getPrice < $parents->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}