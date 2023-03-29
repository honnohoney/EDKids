<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\validator;

use application\core\BaseValidator;
use application\model\Hanahahaha;
class HanahahahaValidator extends BaseValidator
{
    public function __construct(Hanahahaha $hanahahaha)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $hanahahaha;
        $this->validateField('name', self::VALIDATE_REQUIRED);

        //Custom Validate
        /*
        if($hanahahaha->getPrice < $hanahahaha->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}