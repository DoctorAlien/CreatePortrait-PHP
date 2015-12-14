<?php
//======================================================================
// Project Name:Auto Create Portrait
// Auther:		DoctorAlien
// Created Time:2015/12/12
//======================================================================
class Portrait{
	public $img_width=150;							#默认图片统一宽度100	
	public $font_file='./font/simhei.ttf' ;			#默认字体文件
	public $name_string="默认";            			#默认昵称
	public $name_selected=0;               			#默认输出第一个分割后的字符  0:第一个
	public $charset="utf-8";               			#默认昵称编码
	
	//图片 RGB
	public $img_red=0;
	public $img_green=0;
	public $img_blue=0;								#默认图片黑色
	//字体颜色RGB
	public $fontcolor_red=255;
	public $fontcolor_green=255;
	public $fontcolor_blue=255;						#默认字体白色
	
	private $image;									#图片
	private $name_arr;                      		#输出的字符串
	private $img_bgcolor;				   			#图片背景
	private $matches;                       		#正则判断后的字符存储	
	
//======================================================================
//最终展示图片
//======================================================================
	public function imgShow()
	{
		$this->imgCreate();							#创建画布
		$this->imgColor();							#设置图片颜色
		$this->imgFill();							#填充画布
		$this->stringToEcho();						#输出分割后的字符串
		$this->nameToImage();						#向画布写入文字
		$this->Show();								#显示图片	
	}
	
//======================================================================
//字符串处理
//======================================================================
	//分割字符串
	private function stringToArr()
	{
		header("Content-type:text/html;charset=utf-8");
		$strLen=mb_strlen($this->name_string,$this->charset);
		while($strLen)
		{
			$array[]=mb_substr($this->name_string,0,1,$this->charset);
			$this->name_string=mb_substr($this->name_string,1,$strLen,$this->charset);
			$strLen=mb_strlen($this->name_string);
		}
		return $array[$this->name_selected];
	}
	//输出分割后的字符串
	private function stringToEcho()
	{
		$this->name_arr=$this->stringToArr();
	}
	//向画布写入文字
	private function nameToImage()
	{
		$fontcolor=imagecolorallocate($this->image,  $this->fontcolor_red ,  $this->fontcolor_green ,  $this->fontcolor_blue );
		if(preg_match("/^([0-9a-zA-Z_]|[[:punct:]])$/", $this->name_arr, $this->matches))
		{
			imagefttext ( $this->image ,  $this->img_width*0.52 ,  0 ,  $this->img_width*0.33 ,  $this->img_width*0.7 ,  $fontcolor ,  $this->font_file ,  $this->matches[0] );
		} 
		else
		{
			imagefttext ( $this->image ,  $this->img_width*0.52 ,  0 ,  $this->img_width*0.17 ,  $this->img_width*0.73 ,  $fontcolor ,  $this->font_file ,  $this->name_arr );
		}
	}
//======================================================================
//画布处理
//======================================================================
	//创建画布
	private function imgCreate()
	{
		$this->image=imagecreatetruecolor($this->img_width,$this->img_width);
	}
	//设置图片颜色
	private function imgColor()
	{
		$this->img_bgcolor=imagecolorallocate($this->image,$this->img_red,$this->img_green,$this->img_blue);
	}
	//填充画布
	private function imgFill()
	{
		imagefill($this->image,0,0,$this->img_bgcolor);
	}	
	//显示图片
	private function Show()
	{
		header('content-type:image/png');
		imagepng($this->image);
	}
	//销毁图片
	public function __destruct()
	{
		imagedestroy($this->image);
	}
}