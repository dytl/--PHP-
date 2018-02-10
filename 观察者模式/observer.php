<?php
/**
 * 观察者模式：
 * 当一个对象状态发生改变时，依赖它的对象会全部收到通知，并自动更新；
 *
 * 传统的编码方式，就是在事件代码后直接加入逻辑代码，这样当更新的逻辑增加后，
 * 代码会变得难以维护，这种方式是耦合的，侵入式的，增加新的逻辑需要修改事件
 * 主体的代码；
 *
 * 观察者模式实现了低耦合，非侵入式的通知和更新机制；
 */

//***** 传统的编码 ****************
class EventO
{
	public function trigger()
	{
		//事件发生改变
		echo 'Event';

		//需更新的逻辑
		echo 'logic-1';
		echo 'logic-2';
		echo 'logic-3';
		//...
	}
}

//*****观察者模式*********************


//观察者接口
interface Observer{
	public function update($_event = null);
}

//被观察者基类
abstract class EventGenerator{
	//观察者容器
	private $observers = array();
	//将观察者添加到容器中
	public function addObserver(Observer $observer){
		$this->observers[] = $observer;
	}
	//依次执行容器中观察者的事件
	public function notify(){
		foreach ($this->observers as $observer) {
			$observer->update();
		}
	}
}

//被观察者事件
class Event extends EventGenerator{
	public function trigger(){
		//事件发生改变
		echo 'Event'."\n";
		//告知观察者，执行其相应事件
		$this->notify();
	}
}


//观察者01
class Oberver01 implements Observer{
	public function update($_event = null){
		echo 'logic-1'."\n";
	}
}

//观察者02
class Oberver02 implements Observer{
	public function update($_event = null){
		echo 'logic-2'."\n";
	}
}
//更多的观察者 ...

$event = new Event;
$event->addObserver(new Oberver01);
$event->addObserver(new Oberver02);
//...
$event->trigger();






