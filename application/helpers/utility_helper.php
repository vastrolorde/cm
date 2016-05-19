<?php if(! defined('BASEPATH')) exit('no direct script access allowed');
if(!function_exists('asset_url()'))
{
	function asset_url(){
		return base_url().'assets/';
	}
}
?>