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
ca_fancy_assets();
function ca_fancy_assets()
{

	foreach (sfConfig::get('app_caMarkdownEditorPlugin_javascripts') as $javascript)
	{
		sfContext::getInstance()->getResponse()->addJavascript($javascript, 'last');
	}
	foreach (sfConfig::get('app_caMarkdownEditorPlugin_stylesheets') as $stylesheet)
	{
		sfContext::getInstance()->getResponse()->addStylesheet($stylesheet, 'last');
	}
}