<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/22
 * Time: 10:50
 */

namespace App\Validate;


use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class Validate extends Validator
{

    /**
     * 检查 错误
     * $rule 变量
     * $message 错误
     * $scene 规则
     */
    public function check($inputs, $scene)
    {

        $input = $this->getInput($inputs, $scene);
        $rules = $this->getRules($scene);
        $messages = $this->getMessage($rules);

        $validator = Validator::make($input, $rules, $messages);

        //返回错误信息
        if ($validator->fails()) {
            return $validator->errors()->first(); //返回错误信息
        }
        return false;
    }

    /**
     * 获得验证数据
     * @param $inputs
     * @param $scene
     * @return mixed
     */
    public function getInput($inputs, $scene)
    {
        $input = [];
        foreach ($this->scene[$scene] as $key => $v) {
            if (array_key_exists($v, $inputs)) {
                $input[$v] = $inputs[$v];
            }
        }
        return $input;
    }

    /**
     * 获取验证规则
     * @param $scene
     * @return mixed
     */
    public function getRules($scene)
    {
        if ($this->scene[$scene]) {
            foreach ($this->scene[$scene] as $field) {
                if (array_key_exists($field, $this->rule)) {
                    $rules[$field] = $this->rule[$field];
                }
            }
        }
        return $rules;
    }


    /***
     * 返回验证message
     * @param $rules
     * @return array
     */
    public function getMessage($rules)
    {
        foreach ($rules as $key => $v) {
            $arr = explode('|', $v);
            foreach ($arr as $k => $val) {
                if (strpos($val, ':')) {
                    unset($arr[$k]);
                    $arr[] = substr($val, 0, strpos($val, ':'));
                }
            }
            foreach ($arr as $value) {
                if (array_key_exists($key . '.' . $value, $this->message)) {
                    $message[$key . '.' . $value] = $this->message[$key . '.' . $value];
                }
            }
        }
        return $message;
    }
}