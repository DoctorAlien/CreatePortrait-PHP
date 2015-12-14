<?php
	require"portrait.class.php";
	$image=new Portrait();
	$image->name_string="这是一个测试!Thisistest";  //昵称
	$image->name_selected=rand(0,16);				//第几位昵称
	$image->img_width=rand(100,500);				//图片宽度
	$image->img_red=rand(0,255);					//图片颜色rgb
	$image->img_green=rand(0,255);
	$image->img_blue=rand(0,255);
	$image->fontcolor_red=rand(0,255);				//字体颜色rgb
	$image->fontcolor_green=rand(0,255);
	$image->fontcolor_blue=rand(0,255);
	$image->imgShow();								//显示图片
?>