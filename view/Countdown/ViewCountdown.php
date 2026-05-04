<?php 
class ViewCountdown extends ViewUserControl
{
	var $localization;
	var $available_languages;
	var $until_or_since;
	var $compact;
	var $format;
	var $layout;
	var $significant;
	var $description;
	var $override_timezone;
	var $timezone;
	
	function initUserControl()
	{	
		$this->available_languages = array('ar','bg','bn','bs','ca','cs',
											'cy','da','de','el','en','es',
											'et','fa','fi','fr','gl',
											'gu','he','hr','hu','hy','id',
											'it','ja','kn','ko',
											'lt','lv','ml','ms','my','nb','nl',
											'pl','pt-BR','ro',
											'ru','sk','sl','sq','sr','sr-SR',
											'sv','th','tr','uk',
											'uz','vi','zh-CN','zh-TW');

		$this->until_or_since = 'until';
		$this->compact = false;
		$this->format = 'dHMS';
		$this->layout = '';
		$this->significant = 0;
		$this->description = '';
		$this->override_timezone = false;
		$this->timezone = 'Europe/London';
		$this->localization = 'en';
		
		
		if(in_array($this->settings['localization'], $this->available_languages))
			$this->localization = $this->settings['localization'];
		else
			$this->localization = 'en';

		if(isset($this->settings['until_or_since']) && $this->settings['until_or_since'] != 'until')
			$this->until_or_since = 'since';
			
		if(isset($this->settings['compact']) && $this->settings['compact'])
			$this->compact = $this->settings['compact'];		

		if(isset($this->settings['format']) && $this->settings['format'] != 'dHMS')
			$this->format = $this->settings['format'];

		if(isset($this->settings['layout']) && $this->settings['layout'] != '')
			$this->layout = $this->settings['layout'];
			
		if(isset($this->settings['significant']) && $this->settings['significant'] != 0)
			$this->significant = $this->settings['significant'];
			
		if(isset($this->settings['description']) && $this->settings['description'] != '')
			$this->description = $this->settings['description'];
						
			
		if(isset($this->settings['override_timezone']) && $this->settings['override_timezone'])
		{
			$this->override_timezone = $this->settings['override_timezone'];
		}
		
		if(isset($this->settings['timezone']) && $this->settings['timezone'] != 'Europe/London')
		{
			$this->timezone = $this->settings['timezone'];
		}
		
		if(isset($this->settings['override_labels']) && $this->settings['override_labels'])
		{
			$this->addJSControlSetting('override_labels', $this->settings['override_labels']);
			$this->addJSControlSetting('labels', $this->settings['labels']);
			$this->addJSControlSetting('labels1', $this->settings['labels1']);
			$this->addJSControlSetting('compactLabels', $this->settings['compactLabels']);
			$this->addJSControlSetting('digits', $this->settings['digits']);
			$this->addJSControlSetting('timeSeparator', $this->settings['timeSeparator']);
			$this->addJSControlSetting('isRTL', $this->settings['isRTL']);
		}
		
		$this->addJSControlSetting('until_or_since', $this->until_or_since);
		$this->addJSControlSetting('format', $this->format);	
		$this->addJSControlSetting('layout', $this->layout);	
		$this->addJSControlSetting('compact', $this->compact);	
		$this->addJSControlSetting('significant', $this->significant);	
		$this->addJSControlSetting('description', $this->description);		
	}
	
	function showDBValue(&$data, $keylink, $html = true)
	{	
		$id_field = explode('=',$keylink);
		
		if($this->override_timezone)
		{
			$datetime = new DateTime($data[$this->field], new DateTimeZone($this->timezone));
		}
		else
		{
			$datetime = new DateTime($data[$this->field]);
		}

		return '<span id="countdown_'.$this->field.'_'.$id_field[1].'" y="'.$datetime->format('Y').'" m="'.$datetime->format('m').'" d="'.$datetime->format('d').'" h="'.$datetime->format('H').'" i="'.$datetime->format('i').'" s="'.$datetime->format('s').'"></span>';
	}

	/**
	 * addJSFiles
	 * Add control JS files to page object
	 */
	function addJSFiles()
	{
		$this->pageObject->addJSFile("include/Countdown_plugin/jquery.countdown.js");
		if($this->localization != 'en')
			$this->pageObject->addJSFile("include/Countdown_plugin/locales/jquery.countdown-".$this->localization.".js");
	}
	
	function addCSSFiles()
	{
		$this->pageObject->addCSSFile("include/Countdown_plugin/css/jquery.countdown.css");
	}
}