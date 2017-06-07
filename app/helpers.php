<?php

function form_input_text($name, $value="", $className='form-control', $placeholder=''){
	return sprintf('<input type="text" name="%s" value="%s" class="%s" placeholder="%s"/>',
		$name,
		$value,
		$className,
		$placeholder
	);
}

function form_input_hidden($name, $value="", $className='form-control', $placeholder=''){
	return sprintf('<input type="hidden" name="%s" value="%s" class="%s" placeholder="%s"/>',
		$name,
		$value,
		$className,
		$placeholder
	);
}

function form_textarea($name, $value="", $className='form-control', $placeholder='', $rows = 3){
	return '<textarea name="'.$name.'" class="'.$className.'" placeholder="'.$placeholder.'" rows="'. $rows.'"/>'.$value.'</textarea>';
}

function form_select($name, $currentValue="", $className='form-control', $options=''){
	// print_r($options);exit;
	$html = '<select name="'.$name.'" class="'.$className.'">';
	$html .= '<option value="0">-- 默认 --</option>';
	foreach ($options as $key => $val) {
		$isSelected = ($currentValue == $val) ? 'selected="selected"' : '';
		$html .= '<option value="'.$key.'" '.$isSelected.'>'.$val.'</option>';
	}
	$html .= '</select>';
	return $html;
}

function form_group(){

}
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;


function formBuilder($type = '', $item = '', $options = []){
	$html = '        <form id="myForm" accept-charset="UTF-8" class="simple_form form-horizontal" method="post" novalidate="novalidate"><input type="hidden" name="_submit" value="1" />';
	$html .= csrf_field();

	try {
		if ($type == 'category'){
	    	$content = Yaml::parse(file_get_contents(config_path('admins/category.yaml')));

		} elseif ($type == 'links' ) {
	    	$content = Yaml::parse(file_get_contents(config_path('admins/links.yaml')));
		}
	    // print_r($content);
	} catch (ParseException $e) {
	    printf("Unable to parse the YAML string: %s", $e->getMessage());
	}
	$editFields = $content['edit_fields'];
	// print_r($options);exit;
	foreach ($editFields as $fieldName => $rows) {
 
 		$currentValue = isset($item[$fieldName]) ? $item[$fieldName] : '';
 		if ($rows['element'] == 'input-text'){
			$data = form_input_text($rows['name'], $currentValue, $rows['className'], $rows['placeholder']);
 		} elseif ($rows['element'] == 'select'){
 			$options = isset($options[$fieldName]) ? $options[$fieldName] : [];
 			// print_r($options);exit;
			$data = form_select($rows['name'], $currentValue, $rows['className'], $options);
 		} elseif ($rows['element'] == 'textarea'){
 			// $options = isset($options[$fieldName]) ? $options[$fieldName] : [];
 			// print_r($options);exit;
			$data = form_textarea($rows['name'], $currentValue, $rows['className'], $rows['placeholder']);
 		} 
		// function form_input_text($name, $value="", $className='form-control', $placeholder=''){

		$html .= '<div class="form-group">
                <label class="col-md-3 control-label" for="source_link">'. $rows['title'] .'</label>
                <div class="col-md-8">
                '. $data .'</div></div>';
	}

	$html .= '<div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button id="formSubmitBtn" type="button" name="commit" class="btn btn-success">保存修改</button>
                </div>
            </div>';
    $html .= '</form>';
    return $html;
}
