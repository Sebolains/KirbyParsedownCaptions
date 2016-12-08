<?php

#
#
# Parsedown Figure Captions for Kirby CMS
#
# Requres PHP 5.4.0 or later
#
# A simple Kirby plugin consisting of a Parsedown extension to wrap images in figure tags and add their title or alt text as captions.
# By Sebastian Maurino
#
#

	trait ParsedownCaptionsTrait
	{
		protected function element(array $Element)
		{			
			$markup = parent::element($Element);
			
			if($Element['name'] == 'img')
			{
				$caption = '';
				
				if (isset($Element['attributes']['title']))
				{
					$caption = $Element['attributes']['title'];
				} elseif (isset($Element['attributes']['alt']))
				{
					$caption = $Element['attributes']['alt'];
				}
				
				$markup = '<figure>' . $markup;
				
				if ($caption != '')
				{
					$markup .= '<figcaption>' . $caption . '</figcaption>';
				}
				
				$markup .= '</figure>';
			}
			
			return $markup;
		}
	}

	class ParsedownCaptionsExtra extends ParsedownExtra
	{
		use ParsedownCaptionsTrait;
	}

	class ParsedownCaptions extends Parsedown
	{
		use ParsedownCaptionsTrait;
	}

	class MarkdownCaptionExtension extends Kirby\Component\Markdown
	{
		public function parse($markdown) {

			if(!$this->kirby->options['markdown']) {
				return $markdown;
			} else {
				// initialize the right markdown class
				$parsedown = $this->kirby->options['markdown.extra'] ? new ParsedownCaptionsExtra() : new ParsedownCaptions();

				// set markdown auto-breaks
				$parsedown->setBreaksEnabled($this->kirby->options['markdown.breaks']);

				// parse it!
				return $parsedown->text($markdown);
			}

		}
	}
	
	$kirby->set('component', 'markdown', 'MarkdownCaptionExtension');

?>