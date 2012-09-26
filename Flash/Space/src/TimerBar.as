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
		private var backplate:Loader;
		private var sliver:Loader;
		private var bar:Loader;
		
		
		public function TimerBar(p_main:Main,px:Number,py:Number) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			
			backplate = new Loader();
			backplate.contentLoaderInfo.addEventListener(Event.COMPLETE, onBackplateReady);
			backplate.load(new URLRequest(main.prefix + "assets/timerBackplate.png"));
			
			bar = new Loader();
			bar.contentLoaderInfo.addEventListener(Event.COMPLETE, onBarReady);
			bar.load(new URLRequest(main.prefix + "assets/timerBar.png"));
			
			sliver = new Loader();
			sliver.contentLoaderInfo.addEventListener(Event.COMPLETE, onSliverReady);
			sliver.load(new URLRequest(main.prefix + "assets/sliver.png"));
		}
		
		public function onBackplateReady(e:Event) :void
		{
			main.addChild(backplate);
			main.setChildIndex(backplate, 1);
			backplate.scaleX = 1;		
			backplate.scaleY = 1;
			backplate.x = positionX - backplate.width / 2 * backplate.scaleX;
			backplate.y = positionY - backplate.height / 2 * backplate.scaleY;
		} 
		
		public function onSliverReady(e:Event) :void
		{
			main.addChild(sliver);
			main.setChildIndex(sliver, 3);
			sliver.x = positionX - sliver.width / 2 * sliver.scaleX;
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
		
		public function update():void
		{
			bar.scaleX = 1-((getTimer() - main.elapsedTime) / 5000);
			//trace(1-((getTimer() - main.elapsedTime) / 5000));			
		}	
		public function clear():void
		{
			main.removeChild(sliver);
			main.removeChild(bar);
			main.removeChild(backplate);
		}	
	}

}