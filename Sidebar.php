<?php
/**
 * Sidebar.php
 *
 * @author Tim Plath <tim.plath@web.de>
 * @copyright 2013 Tim Plath
 * @license released under dual license BSD License and MIT License
 * @package Sidebar
 * @version 0.2
 */
class Sidebar extends CComponent{
	/**
	 * An array holding all widget names that should be rendered as well as their weight and
	 * options to be passed
	 */
	private $widgets = array();

	/**
	 * width is holding the actual width of the sidebar, by default it is 3
	 */
	private $width = 3;

	public function init(){
        
    }

    public function getWidth() {
    	if(count($this->widgets) !=0)
       		return $this->width;
       	else
    		return 0;
    }

	public function registerWidget($name, $weight, $options = false) {
		$this->widgets[] = array($name, $weight, $options);
	}

	public function subTabs($items) {
        $this->widgets[] = array('bootstrap.widgets.TbTabs', -1, array(
            'type'=>'pills',
            'stacked'=>true,
            'tabs'=>$items,
        ));
	}

	public function render() {
		if(count($this->widgets) != 0) {
			usort($this->widgets, function($a, $b) {
			    return $a[1] - $b[1];
			});
			echo '<div class="span3"><div id="sidebar">';
			foreach($this->widgets as $key=>$value) {
				Yii::app()->controller->widget($value[0],$value[2]);
			}
			echo '</div></div><!-- sidebar -->';
		}
		return true;
	}
}