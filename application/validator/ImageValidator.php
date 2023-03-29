<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\validator;

use application\core\BaseValidator;
use application\model\Image;
class ImageValidator extends BaseValidator
{
    public function __construct(Image $image)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $image;

        //Custom Validate
        /*
        if($image->getPrice < $image->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}