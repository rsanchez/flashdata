<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
	'pi_name' => 'Flashdata',
	'pi_version' => '1.0.0',
	'pi_author' => 'Rob Sanchez',
	'pi_author_url' => 'https://github.com/rsanchez/flashdata',
	'pi_description' => 'Store session data, available for the next server request.',
	'pi_usage' => Flashdata::usage()
);

class Flashdata
{
	protected $EE;

	public function __construct()
	{
		$this->EE =& get_instance();
	}

	public function __call($key, $args)
	{
		$this->EE->TMPL->tagparams['key'] = $key;

		//set
		if (isset($this->EE->TMPL->tagparams['value']) || ! empty($this->EE->TMPL->tagdata))
		{
			return $this->set();
		}

		return $this->get();
	}
	
	public function set()
	{
		if ($key = $this->EE->TMPL->fetch_param('key'))
		{
			$value = $this->EE->TMPL->fetch_param('value', $this->EE->TMPL->tagdata);
		
			$this->EE->session->set_flashdata($key, $value);
		}
		
		return '';
	}
	
	public function get()
	{
		$key = $this->EE->TMPL->fetch_param('key');
		
		return $key ? $this->EE->session->flashdata($key) : '';
	}
	
	public static function usage()
	{
		ob_start(); 
?>
### Get Flashdata

	{exp:flashdata:get key="previous_last_segment"}

OR

	{exp:flashdata:your_key}

### Set Flashdata

	{exp:flashdata:set key="last_last_segment" value="{last_segment}"}

OR

	{exp:flashdata:set key="previous_last_segment"}{last_segment}{/exp:flashdata:set}

OR

	{exp:flashdata:your_key}your data here{/exp:flashdata:your_key}
<?php
		$buffer = ob_get_contents();
		      
		ob_end_clean(); 
	      
		return $buffer;
	}
}
/* End of file pi.flashdata.php */ 
/* Location: ./system/expressionengine/third_party/flashdata/pi.flashdata.php */ 