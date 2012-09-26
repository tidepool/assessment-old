package 
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.utils.getTimer;	  
	import flash.utils.Timer;
	import flash.external.*;

	public class Main extends Sprite 
	{
		private var prefix:String;
		public var loadTime:Number = getTimer();
		
		public function Main():void 
		{
			if (stage) init();
			else addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		private function init(e:Event = null):void 
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			var preLoader:Preloader = new Preloader(this);
		}		
		
		public function makeCall():void
		{
			if (ExternalInterface.available) {
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
	}
	
}