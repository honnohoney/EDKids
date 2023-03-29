<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\validator;

use application\core\BaseValidator;
use application\model\Social;
class SocialValidator extends BaseValidator
{
    public function __construct(Social $social)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $social;
        $this->validateField('upload_time', self::VALIDATE_DATE_TIME);
        $this->validateField('techer_id', self::VALIDATE_INT);
        $this->validateField('image_id', self::VALIDATE_INT);

        //Custom Validate
        /*
        if($social->getPrice < $social->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}