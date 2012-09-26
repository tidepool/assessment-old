package 
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.media.Video;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.external.*;

	/**
	 * ...
	 * @author Wei
	 */
	public class Main extends Sprite 
	{
		public var chart:RadarGraph;
		
		public function Main():void 
		{
			if (stage) init();
			else addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		private function init(e:Event = null):void 
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			addEventListener(Event.ENTER_FRAME, update);
			chart = new RadarGraph(this, 800, 400);				
		}
		
		public function update(e:Event):void
		{
			chart.update();
		}
	
	}
	
}