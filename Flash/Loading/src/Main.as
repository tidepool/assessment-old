package
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.net.URLRequest;
	import flash.utils.getTimer;
	import flash.utils.Timer;
	import flash.external.*;
	
	public class Main extends Sprite
	{
		private var prefix:String;
		private var background:Loader;
		public var loadTime:Number = getTimer();
		private var timerBar:TimerBar;
		private var preLoader:Preloader
		
		public function Main():void
		{
			if (stage)
				init();
			else
				addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		private function init(e:Event = null):void
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			addEventListener(Event.ENTER_FRAME, update);
			background = new Loader();
			background.load(new URLRequest("assets/background.png"));
			addChild(background);
			preLoader = new Preloader(this);
			timerBar = new TimerBar(this, 314, 14);
		}
		
		public function makeCall():void
		{
			if (ExternalInterface.available)
			{
				ExternalInterface.call("sendToJavaScript", "");
			}
			else
			{
				graphics.clear();
				while (numChildren > 0)
				{
					removeChildAt(0);
				}
			}
		}
		
		private function update(e:Event):void
		{
			if (preLoader != null)
			{
				var num:Number = ((preLoader.index / preLoader.url.length))
				timerBar.update(num);
			}
		}
	}

}