<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\validator;

use application\core\BaseValidator;
use application\model\Test;
class TestValidator extends BaseValidator
{
    public function __construct(Test $test)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $test;
        $this->validateField('1', self::VALIDATE_REQUIRED);
        $this->validateField('1', self::VALIDATE_INT);

        //Custom Validate
        /*
        if($test->getPrice < $test->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}