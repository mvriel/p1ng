<?php
/*
 * Copyright (c) 2009 Lukasz Sarzynski [ http://lukasz.sarzynski.biz ]
 * Writing in company codearts [ http://codearts.pl ]
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @author     Lukasz Sarzynski <LukaszSarzynski@gmail.com>
 *
 */
class caWidgetFormMarkdownEditorBasedOnMarkItUp extends sfWidgetFormTextarea
{
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('mark_down_options', sfConfig::get('app_mark_down_default', array()));
  }
  
  /**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @see sfWidget
   **/    
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
 
    $id = $this->generateId($name, $value);

    $script_content = <<<JS
    //<![CDATA[
    $(document).ready(function()	{
      $('#{$id}').markItUp(mySettings,
                    { 	root:'markupsets/markdown/',
                      previewTemplatePath:'/downloads/preview.php',
                      previewAutoRefresh:false
                    }
                  );

      });
    //]]>
JS;
  
    return parent::render($name, $value, $attributes, $errors)
           .$this->renderContentTag('script', $script_content, array('type' => 'text/javascript'));
  }
}