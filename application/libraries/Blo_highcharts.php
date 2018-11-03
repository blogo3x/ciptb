<?php defined('BASEPATH') OR exit('No direct script access allowed');

class blo_highcharts {
	protected $CI;
	protected $chart;
	
	protected $highcharts_script = 
	"Highcharts.chart('{CONTAINER_ID}', {
		chart: {
			type: '{CHART_TYPE}',
			height: {CHART_HEIGHT}
		},
		title: {
			text: '{CHART_TITLE}'
		},
		subtitle: false,
		xAxis: {
			categories: [{CHART_CATEGORIES}],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: '{Y_AXIS_TITLE}'
			}
		},  
		legend:{
			enabled: {CHART_LEGEND}
		},
		credits: {
		    enabled: false
		},
		{CHART_TOOLTIPS}
		plotOptions: {
			{CHART_TYPE}: {
				pointPadding: 0.2,
				borderWidth: 0,
				dataLabels: {
					enabled: true,
				}
			},
			series: {
				colorByPoint: {IS_SINGLE_SERIES}
			}
		},
		series: [{CHART_SERIES}]
	});";

	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function init($chart_id){		
		$this->chart[$chart_id] = (object) array(
										'type' => 'column',
										'height' => '400',
										'title' => '',
										'single_series' => 'true',
										'legend' => 'false',
										'y_axis_title' => '',
										'categories' => '',
										'tooltips' => '',
										'series' => '',
										'script' => ''
									);
	}
	
	public function set_categories($chart_id,$array_val){
		foreach($array_val as $key=>$val){
			$this->chart[$chart_id]->categories .= "'".$val."'," ;
		}
	}
	
	public function set_height($chart_id,$val){
		$this->chart[$chart_id]->height = $val;
	}
	
	public function add_multiple_series($chart_id,$array_val,$name){
		$tmp_string = '{';
		$tmp_string .= 'name:"'.$name.'",';
		$tmp_string .= 'data:[';
		
		foreach($array_val as $key=>$val){
			$tmp_string .= $val."," ;
		}
		
		$tmp_string .= ']},';		
		
		$this->chart[$chart_id]->series .= $tmp_string;
	}
	
	public function add_single_series($chart_id,$array_val,$name=NULL){
		$tmp_string = '{';
		$tmp_string .= 'name:"'.$name.'",';
		$tmp_string .= 'data:[';
		
		foreach($array_val as $key=>$val){
			$tmp_string .= $val."," ;
		}
		
		$tmp_string .= ']},';		
		
		$this->chart[$chart_id]->series .= $tmp_string;
	}
	
	public function set_series($chart_id,$series_val,$name=NULL){
		$this->chart[$chart_id]->single_series = (is_multidimensional_array($series_val))?('false'):('true');
		$this->chart[$chart_id]->legend = (is_multidimensional_array($series_val))?('true'):('false');
		
		if(is_multidimensional_array($series_val)){
			foreach($series_val as $key=>$val){
				$this->add_multiple_series($chart_id,$val,$key);
			}
		}
		else
			$this->add_single_series($chart_id,$series_val,$name);
	}
	
	public function set_type($chart_id,$val){
		$this->chart[$chart_id]->type = strtolower($val);
	}
	
	public function set_title($chart_id,$val){
		$this->chart[$chart_id]->title = $val ;
	}
		
	public function set_y_axis_title($chart_id,$val){
		$this->chart[$chart_id]->y_axis_title = $val ;
	}	
		
	public function set_use_tooltips($chart_id,$is_used,$format=NULL){
		if($is_used){
			if($format==NULL)
				$format = "
				tooltip: {
					headerFormat: '<span style=\"font-size:12px\">{point.x}</span><table>',
					pointFormat: '<tr><td style=\"color:{series.color};padding:0\">Jumlah: </td>' +
						'<td style=\"padding:0\"><b>{point.y}</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},";
			$this->chart[$chart_id]->tooltips = $format ;
		}
	}	
	
	public function generate_script($chart_id){
		$tmp_script = $this->highcharts_script;
		
		$tmp_script = str_replace('{CONTAINER_ID}',$chart_id,$tmp_script);
		$tmp_script = str_replace('{CHART_TYPE}',$this->chart[$chart_id]->type,$tmp_script);
		$tmp_script = str_replace('{CHART_TITLE}',$this->chart[$chart_id]->title,$tmp_script);
		$tmp_script = str_replace('{Y_AXIS_TITLE}',$this->chart[$chart_id]->y_axis_title,$tmp_script);
		$tmp_script = str_replace('{CHART_CATEGORIES}',$this->chart[$chart_id]->categories,$tmp_script);
		$tmp_script = str_replace('{CHART_LEGEND}',$this->chart[$chart_id]->legend,$tmp_script);
		$tmp_script = str_replace('{CHART_SERIES}',$this->chart[$chart_id]->series,$tmp_script);
		$tmp_script = str_replace('{CHART_TOOLTIPS}',$this->chart[$chart_id]->tooltips,$tmp_script);
		$tmp_script = str_replace('{CHART_HEIGHT}',$this->chart[$chart_id]->height,$tmp_script);
		$tmp_script = str_replace('{IS_SINGLE_SERIES}',$this->chart[$chart_id]->single_series,$tmp_script);
		$tmp_script = trim(preg_replace('/\s+/', ' ', $tmp_script));
		
		$this->chart[$chart_id]->script = $tmp_script;
	}
	
	public function generate_all_scripts(){
		foreach($this->chart as $key=>$val){
			$this->generate_script($key);
		}
	}
	
	public function get_script($chart_id){
		return $this->chart[$chart_id]->script;
	}
	
	public function get_all_scripts(){
		$tmp = '<script>';
		foreach($this->chart as $key=>$val){
			$tmp .= $val->script;
		}
		$tmp .= '</script>';
		return $tmp;
	}
	
	public function get_container($chart_id){
		return '<div id="'.$chart_id.'"></div>';
	}
}
