package  
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.ui.Mouse;
	import flash.utils.getTimer;	  
	import flash.utils.Timer;
	
	public class EndScreen
	{
		public var main:Main;
		private var pic:picture;
		private var elapsedTime:Number;
		
		public function EndScreen(p_main:Main) 
		{
			main = p_main;
		}
		
		public function render():void
		{
			pic = new picture(main, 800, 400, "assets/ocean.jpg", 1000);
			//pic.sprite.addEventListener(MouseEvent.CLICK, displayNext); 
			elapsedTime = getTimer();
		}
		
		public function update():void
		{
			if (getTimer() - elapsedTime > 1000)
			{			
				displayNext();
			}
		}
		
		
		public function writeXML():void
		{
			main.changesString += "</changes>";
			main.xmlString += main.changesString;
			main.xmlString += "</beach>";
			trace (main.xmlString);
			var xmlData:XML = new XML(main.xmlString);
			trace (xmlData);
			main.postData();
		}
		
		
		public function displayNext():void
		{
			main.displayNext();
		}
	}

}