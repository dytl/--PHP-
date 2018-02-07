<?php
/**
 * 原型模式：
 * 原型模式是先创建好一个原型对象，任何通过clone原型对象来创建新的对象；
 * 
 * 原型模式适合大对象的创建，创建一个大对象需要很大的开销，每次new会消耗很大，
 * 原型模式仅需内存拷贝即可；
 *
 * 也免去了类创建时重复的初始化操作；
 */

class Prototype{
	public __construct(){
		$this->init();
	}
	private function init(){
		//初始化操作
		//...
	}
	public function show(){
		//function
	}
}

//*******原型模式前****************************

$pro01 = new Prototype();
$pro01->show();

$pro02 = new Prototype();
$pro03->show();


//*******原型模式后****************************

$pro = new Prototype();

$pro01 = clone $pro;
$pro01->show();

$pro02 = clone $pro;
$pro02->show();




