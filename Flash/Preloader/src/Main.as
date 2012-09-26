package 
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.*;
	import flash.net.*;
	import flash.text.*;
	import flash.external.*;
	
	public class Main extends Sprite 
	{
		private var MyFile:FileReference = new FileReference();
		private var strings:Array = new Array();
		private var preLoader:Preloader;

		public function Main():void 
		{
			if (stage) init();
			else addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		private function init(e:Event = null):void 
		{
			preLoader = new Preloader(this);			
		}
	}	
}
