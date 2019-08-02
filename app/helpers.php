<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

if (!function_exists('admin_iew')) {
    /**
     * @param null  $view
     * @param array $data
     * @param array $mergeData
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function admin_iew($view = null, $data = [], $mergeData = [])
    {
        return view($view, $data, $mergeData);
    }
}

if (!function_exists('theme_view')) {
    /**
     * @param null  $view
     * @param array $data
     * @param array $mergeData
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function theme_view($view = null, $data = [], $mergeData = [])
    {
        return view('bulma-theme.'.$view, $data, $mergeData);
    }
}

if (!function_exists('markdown')) {
    /**
     * Convert some text to Markdown...
     *
     * @param mixed $text
     */
    function markdown($text)
    {
        return (new ParsedownExtra())->text($text);
    }
}

if (!function_exists('get_user_ip')) {
    /**
     * @return mixed|string
     */
    function get_user_ip()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ip = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_X_CLUSTER_CLIENT_IP')) {
            $ip = getenv('HTTP_X_CLUSTER_CLIENT_IP');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ip = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ip = getenv('HTTP_FORWARDED');
        } elseif (getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } else {
            $ip = 'unknown';
        }

        $ip = filter_var($ip, FILTER_VALIDATE_IP);

        return (false === $ip) ? '0.0.0.0' : $ip;
    }
}

if (!function_exists('get_remote_ip')) {
    /**
     * @return mixed|string
     */
    function get_remote_ip()
    {
        if (getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } else {
            $ip = 'unknown';
        }
        $ip = filter_var($ip, FILTER_VALIDATE_IP);

        return (false === $ip) ? '0.0.0.0' : $ip;
    }
}

if (!function_exists('get_ip_location')) {
    /**
     * @param $ip
     * @param bool $returnStr
     *
     * @return bool|string
     */
    function get_ip_location($ip, $returnStr = true)
    {
        $ip = filter_var($ip, FILTER_VALIDATE_IP);
        if ($ip) {
            $res = IPIP::find($ip);
            if ($returnStr) {
                return is_array($res) ? trim(implode(',', $res), ',') : false;
            }

            return $res;
        }

        return false;
    }
}

if (!function_exists('get_user_agent')) {
    /**
     * @return string
     */
    function get_user_agent()
    {
        return getenv('HTTP_USER_AGENT');
    }
}

if (!function_exists('get_post_detail_cache_key')) {
    /**
     * @param mixed $id
     *
     * @return string
     */
    function get_post_detail_cache_key($id = 0)
    {
        return sprintf('cache_post_%s_%s', date('Ymd'), $id);
    }
}

if (!function_exists('get_cache_key')) {
    /**
     * 获取缓存key.
     *
     * @param string $module
     * @param int    $id
     *
     * @return string
     */
    function get_cache_key($module = '', $id = 0)
    {
        return sprintf('cache_%s_%s_%s', $module, date('Ymd'), $id);
    }
}

/**
 * @param $name
 * @param string $value
 * @param string $className
 * @param string $placeholder
 *
 * @return string
 */
function form_input_text($name, $value = '', $className = 'form-control', $placeholder = '')
{
    return sprintf(
        '<input type="text" name="%s" value="%s" class="%s" placeholder="%s"/>',
        $name,
        $value,
        $className,
        $placeholder
    );
}

/**
 * @param $name
 * @param string $value
 * @param string $className
 * @param string $placeholder
 *
 * @return string
 */
function form_input_hidden($name, $value = '', $className = 'form-control', $placeholder = '')
{
    return sprintf(
        '<input type="hidden" name="%s" value="%s" class="%s" placeholder="%s"/>',
        $name,
        $value,
        $className,
        $placeholder
    );
}

/**
 * @param $name
 * @param string $value
 * @param string $className
 * @param string $placeholder
 * @param int    $rows
 *
 * @return string
 */
function form_textarea($name, $value = '', $className = 'form-control', $placeholder = '', $rows = 3)
{
    return '<textarea name="'.$name.'" class="'
    .$className.'" placeholder="'.$placeholder
    .'" rows="'.$rows.'"/>'.$value.'</textarea>';
}

/**
 * @param $name
 * @param string $currentValue
 * @param string $className
 * @param string $options
 *
 * @return string
 */
function form_select($name, $currentValue = '', $className = 'form-control', $options = '')
{
    // print_r($options);exit;
    $html = '<select name="'.$name.'" class="'.$className.'">';
    $html .= '<option value="0">-- 默认 --</option>';
    foreach ($options as $key => $val) {
        $isSelected = ($currentValue === $key) ? 'selected="selected"' : '';
        $html .= '<option value="'.$key.'" '.$isSelected.'>'
        .$val.' ('.$key.') </option>';
    }
    $html .= '</select>';

    return $html;
}

/**
 * @param string $btnName
 * @param string $btnType
 * @param array  $options
 *
 * @return string
 */
function form_submit_buttion($btnName = '保存修改', $btnType = 'button', $options = [])
{
    return sprintf(
        '<button id="formSubmitBtn" type="%s" name="commit" class="btn btn-success">%s</button>',
        $btnType,
        $btnName
    );
}

/**
 * @param array $formFields
 * @param array $formOptions
 * @param mixed $formOptionList
 * @param mixed $formValueList
 *
 * @return string
 */
function form_create($formFields = [], $formOptionList = [], $formValueList = [])
{
    $editFields = $formFields['edit_fields'] ?? [];
    $editButtons = $formFields['edit_buttons'] ?? [];

    $html = '<form id="myForm" accept-charset="UTF-8" 
    class="simple_form form-horizontal" method="post" novalidate="novalidate">';
    $html .= '<input type="hidden" name="_submit" value="1" />';
    $html .= csrf_field();

    foreach ($editFields as $fieldName => $rows) {
        if ('input-text' === $rows['element']) {
            $currentValue = isset($formValueList[$fieldName]) ? $formValueList[$fieldName] : '';

            $data = form_input_text($rows['name'], $currentValue, $rows['className'], $rows['placeholder']);
        } elseif ('select' === $rows['element']) {
            $currentValue = isset($formValueList[$fieldName]) ? $formValueList[$fieldName] : '';
            $options = isset($formOptionList[$fieldName]) ? $formOptionList[$fieldName] : [];

            $data = form_select($rows['name'], $currentValue, $rows['className'], $options);
        } elseif ('textarea' === $rows['element']) {
            // $options = isset($options[$fieldName]) ? $options[$fieldName] : [];
            $currentValue = isset($formValueList[$fieldName]) ? $formValueList[$fieldName] : '';
            $data = form_textarea($rows['name'], $currentValue, $rows['className'], $rows['placeholder']);
        }
        $html .= '<div class="form-group">
                <label class="col-md-3 control-label" for="source_link">'
                .$rows['title'].'</label>
                <div class="col-md-8">
                '.$data.'</div></div>';
    }

    $btnName = !empty($editButtons['add_button']) ? $editButtons['add_button'] : '提交保存';
    $html .= sprintf(
        '<div class="form-group"><div class="col-md-offset-3 col-md-9">%s</div></div>',
        form_submit_buttion($btnName)
    );
    $html .= '</form>';

    return $html;
}

// ------------------------------------------------------------------------
// --------------------------------------------------------------------
/*
 * 下载CSV文件 (wangyt@20141212)
 *
 * 示例：$AccruedDataArray为导出数据数组
 * $file_name = 'OPS_'.date('Y_m_d').'_'.time();
 * $download_title = array('ID', '月份', '产品ID', '产品线','新建时间');
 * $download_data  = array();//拼装要导出的数据字段
 * foreach ($AccruedDataArray as $key => $row) {
 *       $download_data[$key]['id']          = $row['id'];
 *       $download_data[$key]['date']        = $row['date'];
 *       $download_data[$key]['product_id']  = $row['product_id'];
 *       $download_data[$key]['product_name']= $productList[$row['product_id']]['name'];
 *       $download_data[$key]['create_time'] = ($row['create_time'])?date('Y-m-d H:i:s', $row['create_time']):0;
 * }
 * $this->downloadAsCsvFile($download_title, $download_data, $file_name);
 *
 * @param array $csv_title CSV标题栏
 * @param array $csv_array CSV数据栏
 * @param string $filename CSV文件名
 */
if (!function_exists('download_as_csv_file')) {
    /**
     * @param array  $csvTitle
     * @param array  $csvArr
     * @param string $filename
     */
    function download_as_csv_file(array $csvTitle, array $csvArr, $filename = '')
    {
        if (empty($filename)) { //保存的文件名称
            $filename = 'download_'.date('YmdHis');
        }
        header('Content-type: application/csv');
        header('Content-Transfer-Encoding: binary; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$filename.'.csv');
        $fp = fopen('php://output', 'w');

        //生成bom头
        fwrite($fp, (chr(0xEF).chr(0xBB).chr(0xBF)));
        //生成标题栏: 如果没有设置标题，取一条数据的key值作为标题
        if (empty($csvTitle)) {
//            $csvTitle = !empty($csv_array[0]) ? array_keys($csv_array[0]) : array();
            $csvTitle = array_keys(array_slice($csvArr, 0, 1));
        }
        fputcsv($fp, $csvTitle);

        foreach ($csvArr as $row) {
            fputcsv($fp, $row);
        }

        exit();
    }
}

// 下载Txt文件
if (!function_exists('download_as_txt_file')) {
    /**
     * @param array  $array
     * @param string $filename
     */
    function download_as_txt_file(array $array, $filename = '')
    {
        if (empty($filename)) { //保存的文件名称
            $filename = 'download_'.date('YmdHis');
        }
        header("Content-Disposition: attachment; filename={$filename}.txt");
        header('Content-Type: charset=utf-8');
        $fp = fopen('php://output', 'w');

        //生成bom头
        fwrite($fp, (chr(0xEF).chr(0xBB).chr(0xBF)));
        foreach ($array as $row) {
            $line = implode("\t", $row)."\n";
            fwrite($fp, $line, strlen($line));
        }

        exit();
    }
}

/**
 * @param type  $arrData
 * @param array $data
 *
 * @return bool
 */
function render_api(array $data)
{
    if (empty($data)) {
        return false;
    }
    echo json_encode($data);
    exit;
}

// ------------------------------------------------------------------------

/**
 * @param string $msg
 * @param array  $data
 */
function render_api_success(array $data = [], $msg = 'success')
{
    $result = [
        'code' => 1,
        'msg' => $msg,
        'data' => $data,
        'time' => date('Y-m-d H:i:s'),
    ];
    echo json_encode($result);
    exit;
}

// ------------------------------------------------------------------------

/**
 * @param string $msg
 * @param int    $code
 * @param array  $data
 */
function render_api_error($msg = 'ERROR', $code = 0, array $data = [])
{
    $result = [
        'code' => 1001,
        'msg' => 'fail',
        'data' => null,
        'time' => date('Y-m-d H:i:s'),
    ];
    if (isset($msg)) {
        $result['msg'] = $msg;
    }
    if ($code) {
        $result['code'] = (int) $code;
    }
    if ($data) {
        $result['data'] = $data;
    }
    echo json_encode($result);
    exit;
}

/**
 * 替换空行符等字符.
 *
 * @param [type] $string
 */
function format_description($string)
{
    $search = [
        "\n", "\r", "\r\n", '#', '*',
    ];

    return trim(str_replace($search, '', $string));
}
