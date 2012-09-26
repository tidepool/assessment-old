package  
{
	import flash.events.KeyboardEvent;
	import flash.ui.Keyboard;
	
	public class IntroScreen
	{
		public var main:Main;
		public var text:Label;
		
		public function IntroScreen(p_main:Main) 
		{
			main = p_main;
			text = new Label(main, 0, 0, "");
		}
		
		public function render():void
		{
			text.changeText(400, 200, 45, "This task will allow us to see how you view your world.");
			main.shouldFadeIn = true;
		}
		
		public function update():void
		{
		}
		
		public function writeXML():void
		{			
			main.xmlString += "<pictureSelection>";
		}
		
		public function keyPress():void
		{
			text.remove();
			main.displayNext();
		}
	}

}