package  
{
	import adobe.utils.CustomActions;
	import flash.display.Loader;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.net.URLRequest;
	import flash.utils.getTimer;	
	
	public class TimerBar 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		private var sliver:Loader;
		private var bar:Loader;
		
		
		public function TimerBar(p_main:Main,px:Number,py:Number) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			
			bar = new Loader();
			bar.contentLoaderInfo.addEventListener(Event.COMPLETE, onBarReady);
			bar.load(new URLRequest("assets/timerBar.png"));
			
			sliver = new Loader();
			sliver.contentLoaderInfo.addEventListener(Event.COMPLETE, onSliverReady);
			sliver.load(new URLRequest("assets/sliver.png"));
		}
		
		public function onSliverReady(e:Event) :void
		{
			main.addChild(sliver);
			main.setChildIndex(sliver, main.numChildren-1);
			sliver.x = positionX - sliver.width / 2 * sliver.scaleX - 307;
			sliver.y = positionY - sliver.height / 2 * sliver.scaleY;
		} 
		
		public function onBarReady(e:Event) :void
		{
			main.addChild(bar);
			main.setChildIndex(bar, 2);
			bar.scaleX = 1;
			bar.x = positionX - bar.width / 2 * bar.scaleX;
			bar.y = positionY - bar.height / 2 * bar.scaleY;
		} 
		
		public function update(num:Number):void
		{
			bar.scaleX = num;
			//trace(1-((getTimer() - main.elapsedTime) / 5000));			
		}	
		public function clear():void
		{
			main.removeChild(sliver);
			main.removeChild(bar);
		}	
	}

}