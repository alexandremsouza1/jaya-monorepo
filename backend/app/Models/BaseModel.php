<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

/**
 * Class Base
 * @package App\Models
 * @property string $_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
abstract class BaseModel extends Model implements BaseModelInterface
{
    const PRIMARY_KEY       = 'id';

    protected $dates       = ['created_at', 'updated_at'];


    /**
     * @param $data
     * @return bool
     */
    public function validate()
    {
        $errors = [];
        $validator = app('validator')->make($this->toArray(), $this->rules());
  
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $msg = $this->tranMessage($errors);
            throw new ValidationException($validator, $msg);
        }

        return true;
    }

    private function tranMessage($errors)
    {
        $tips = '';
        foreach ($errors as $k => $v) {
            foreach ($v as $v1) {
                $tips .= $v1.',';
            }
        }
        $end = strrpos($tips,',');
        $tips = substr($tips, 0, $end);
        return $tips;
    }

}
