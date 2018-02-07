<?php
/**
 * 工厂模式
 * #使用同一接口，生成大量不同类的实例
 * #如果实例化对象的子类可能变化，就要使用工厂模式
 * #一个类无法预计它要创建的对象数目，不希望类与它要创建的类紧密绑定
 */

//产品接口
interface Product{
	public function getProperties();
}

//产品
class TextProduct implements Product{  //文本产品
	private $mfgProduct;
	public function getProperties(){
		$this->mfgProduct = 'this is text';
		return $this->mfgProduct;
	}
}

class GraphicProduct implements Product{ //图片产品
	private $mfgProduct;
	public function getProperties(){
		$this->mfgProduct = 'this is a graphic';
		return $this->mfgProduct;
	}
}

//工厂接口
abstract class Creator{
	protected abstract function factoryMethod();
	public function startFactory(){
		$mfg = $this->factoryMethod();
		return $mfg;
	}
}
//产品工厂
class TextFactory extends Creator{  //文本工厂
	public function factoryMethod(){
		$product = new TextProduct();
		return($product->getProperties());
	}
}

class GraphicFactory extends Creator{  //文本工厂
	public function factoryMethod(){
		$product = new GraphicProduct();
		return($product->getProperties());
	}
}

//客户端
class Client{
	private $someTextObject;
	private $someGraphicObject;
	public function __construct(){
		$someTextObject= new TextFactory();
		echo $someTextObject->startFactory()."<br />";
		$someGraphicObject = new GraphicFactory();
		echo $someGraphicObject->startFactory()."<br />";
	}
}

/**
 *****************************************************************************
 * 上面存在的弊端，要是新增产品，对应的产品工厂也要新增；
 * 所以有了下面的参数化工厂：给产品工厂传递不同的产品参数，就会生成对应的产品；
 *****************************************************************************
 */

/**
 * 参数化工厂
 */
abstract class CCreator{
	protected abstract function factoryMethod(Product $product);
	public function doFactory($productNow){
		$countryProduct = $productNow;
		$mfg = $this->factoryMethod($countryProduct);
		return $mfg;
	}
}

//参数化产品工厂
class countryFactory extends CCreator{
	private $country;
	protected function factoryMethod(Product $product){
		$this->country = $product;
		return($this->country->getProperties());
	}
}

//参数化客户端
class CClient{
		private $countryFactory;
		public function __construct(){
			$this->countryFactory = new countryFactory();
			echo $this->countryFactory->doFactory(new TextFactory());
		}
}

/**
 * 辅助类概念:诸多产品中的公共部门可以提取出放到一个公共类中，及辅助类；
 */

$worker = new Client();


