<?php
/**
 * 适配器模式
 */
/**
 * 使用继承的适配器模式  类适配器
 * 例子：单位是美元的计算系统通过适配器兼容处理欧元
 */

//美元计算 (具体类)
class  DollarCalc{
	private $dollar;
	private $product;
	private $service;
	public $rate = 1;

	public function requestCalc($productNow,$serviceNow){
		$this->productNow = $productNow;
		$this->service = $serviceNow;
		$this->dollar = $this->product + $this->service;
		return $this->requestTotal();
	}

	public function requestTotal(){
		$this->dollar *= $this->rate;
		return $this->dollar;
	}
}

//欧元计算  (具体类)
class  EuroCalc{
	private $euro;
	private $product;
	private $service;
	public $rate = 1;

	public function requestCalc($productNow,$serviceNow){
		$this->productNow = $productNow;
		$this->service = $serviceNow;
		$this->euro = $this->product + $this->service;
		return $this->requestTotal();
	}

	public function requestTotal(){
		$this->euro *= $this->rate;
		return $this->euro;
	}
}


//适配器类接口
interface ITarget{
	function requester();
}

//适配器类 : 主要工作就是处理美元和欧元之间的转换率
class EuroAdapter extends EuroCalc implements ITarget{
	public function __construct(){
		$this->requester();
	}
	public function requester(){
		$this->rate = 0.8111;
		return $this->rate;
	}
}

//客户端
class Client{
	private $requestNow;
	private $dollarRequest;
	public function __construct(){
		$this->requestNow = new EuroAdapter();
		$this->dollarRequest = new DollarCalc();
		echo "Euro:".$this->makeAdapterRequest($this->requestNow)."<br />";
		echo "Dollars:".$this->makeDollarRequest($this->dollarRequest);
	}
	public function makeAdapterRequest(ITarget $req){
		return $req->requestCalc(40,50);
	}
	public function makeDollarRequest(DollarCalc $req){
		return $req->requestCalc(40,50);
	}
}

$worker = new Client();



/**
 * 使用组合适配器模式  对象适配器
 * 例子：页面开发从PC转向APP
 */

//PC页面接口
interface IFormat{
	public function formatCss();
	public function formatGraphics();
	public function horizontalLayout();
}

//PC页面具体类
class Desktop implements IFormat{
	public function formatCss(){
		echo 'Desktop::formatCss';
	}
	public function formatGraphics(){
		echo 'Desktop::formatGraphics';
	}
	public funciton horizontalLayout(){
		echo 'Desktop::horizontalLayout';
	}
}

//APP页面接口
interface IMobileFormat{
	public function formatCss();
	public function formatGraphics();
	public function vertivalLayout();
}
//APP页面具体类
class Mobile implements IMobileFormat{
	public function formatCss(){
		echo 'Mobile::formatCss';
	};
	public function formatGraphics(){
		echo 'Mobile::formatGraphics';
	};
	public function vertivalLayout(){
		echo 'Mobile::vertivalLayout';
	};
}

//适配器类
class MobileAdapter implements IFormat{
	private $mobile;
	public funciton __construct(IMobileFormat $mobileNow){
		$this->mobile = $mobileNow;
	}
	public function formatCss(){
		$this->mobile->formatCss();
	}
	public function formatGraphics(){
		$this->mobile->formatGraphics();
	}
	public function horizontalLayout(){
		$this->mobile->vertivalLayout();
	}
}
//客户端
class Client{
	private $mobile;
	private $mobileAdapter;
	public function __construct(){
		$this->mobile = new Mobile();
		$this->mobileAdapter = new MobileAdapter($this->mobile);
		$this->mobileAdapter->formatCss();
		$this->mobileAdapter->formatGraphics();
		$this->mobileAdapter->horizontalLayout();
	}
}

$worker = new Client();


