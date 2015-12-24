<?php

namespace Group\Twig;

use Twig_Extension;
use Route;

class WebExtension extends Twig_Extension
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
			'url'   => new \Twig_Function_Method($this, 'getUrl') ,
			'dump'  => new \Twig_Function_Method($this, 'dump') ,
		);
	}

    /**
	 * 获取asset目录下得文件路径
	 *
	 * @return string
	 */
	public function getPublic($url)
	{
		return "/".$url;
	}

    /**
	 * 获取路由
	 *
	 * @return string
	 */
	public function getUrl($url, $params = [])
	{
		Route::deParse($url, $params);
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

	public function getName()
	{
		return 'group_twig';
	}
}
