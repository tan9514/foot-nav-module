<?php

namespace Modules\FootNav\Http\Requests\Admin;

use Modules\FootNav\Http\Requests\BaseRequest;

class FootNavSettingRequest extends BaseRequest
{
    /**
     * 判断用户是否有请求权限
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * 获取规则
     * @return string[]
     */
    public function newRules()
    {
        return [
            'head' => 'required|array',
            'head.backcolor' => 'required|string|min:1',
            'head.fontcolor' => 'required|integer|min:0|max:1',
            'foot' => 'nullable|array',
        ];
    }

    /**
     * 获取自定义验证规则的错误消息
     * @return array
     */
    public function messages()
    {
        return [
//            'phone.regex' => "请输入正确的 :attribute",
        ];
    }

    /**
     * 获取自定义参数别名
     * @return string[]
     */
    public function attributes()
    {
        return [
            "head" => "顶部导航",
            "head.fontcolor" => "顶部导航文字颜色",
            "head.backcolor" => "顶部导航背景颜色",
            "foot" => "底部导航",
        ];
    }

    /**
     * 验证规则
     */
    public function check()
    {
        $validator = \Validator::make($this->all(), $this->newRules(), $this->messages(), $this->attributes());
        $error = $validator->errors()->first();
        if($error){
            return $this->resultErrorAjax($error);
        }
    }
}
