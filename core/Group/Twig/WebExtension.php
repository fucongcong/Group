<?php
namespace core\Group\Twig;

use Twig_Extension;

Class WebExtension extends Twig_Extension
{
    /**
	* 重写Twig_Extension getFunctions方法
	*
	* @return array
	*/
 	public function getFunctions()
	{
		return array(
			'asset' => new \Twig_Function_Method($this, 'getPublic') ,
			'url' => new \Twig_Function_Method($this, 'getUrl') ,
			'dump' => new \Twig_Function_Method($this, 'dump') ,
		);
	}

    /**
	* 获取asset目录下得文件路径
	*
	* @return string
	*/
	public function getPublic($url)
	{
		if(!defined('IS_CGI')) {

			define('IS_CGI',(0 === strpos(PHP_SAPI,'cgi') || false !== strpos(PHP_SAPI,'fcgi')) ? 1 : 0 );
		}
		if(!defined('_PHP_FILE_')) {
	        	if(IS_CGI) {

		            $_temp  = explode('.php',$_SERVER['PHP_SELF']);
		            define('_PHP_FILE_',    rtrim(str_replace($_SERVER['HTTP_HOST'],'',$_temp[0].'.php'),'/'));
		        }else {
		            define('_PHP_FILE_',    rtrim($_SERVER['SCRIPT_NAME'],'/'));
		        }
	    	}
        		$_root  =   rtrim(dirname(_PHP_FILE_),'/');
        		if(!defined('__ROOT__')) {

        			define('__ROOT__',  (($_root=='/' || $_root=='\\')?'':$_root));
        		}
		return __ROOT__."/".$url;
	}

	public function getUrl($url)
	{

	}

    /**
	* 在模板调试使用
	*
	* @param var
	* @return void
	*/
	public function dump($var)
	{
		return var_dump($var);
	}

	public function getName ()
	{
		return 'group_twig';
	}

}