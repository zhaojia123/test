<?php
/**
 * Created by PhpStorm.
 * User: mayan
 * Date: 2018/4/11
 * Time: 上午10:45
 */

return [
  'rules' => [
      'id' => 'required',
      'textbook_describe' => 'max:50',
  ],
    'message'   =>[
        'required'=>':attribute 的字段是必要的。',
        'unique'=>':attribute 的字段是唯一的。',
    ],
];