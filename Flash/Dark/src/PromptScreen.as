package  
{
	import flash.events.KeyboardEvent;
	import flash.ui.Keyboard;
	import flash.utils.getTimer;
	
	public class PromptScreen 
	{
		private var main:Main;
		private var text1:Label;
		private var text2:Label;
		private var text3:Label;
		private var startTime:Number;
		private var s:String;
		private var pics:Picture6Select;
		
		public function PromptScreen(p_main:Main,p_s:String="Moon") 
		{
			main = p_main;
			text1 = new Label(main, 0, 0, "");
			text2 = new Label(main, 0, 0, "");
			text3 = new Label(main, 0, 0, "");
			s = p_s;
		}
		
		public function render():void
		{
			text1.changeText(400, 200, 60, s);
			text2.changeText(400, 300, 45, "Close your eyes and imagine what this object looks like to you. Take a moment to really notice what you see.");
			startTime = getTimer();
		}
		
		public function update():void
		{
			if (getTimer() - startTime > 3000)
			{
				if (pics == null)
				{
					main.shouldFadeIn = true;
				}
			}
		}
		
		public function writeXML():void
		{			
		}
		
		public function keyPress():void
		{
			if (pics == null)
			{
				if (getTimer() - startTime < 3000)
				{
					return;
				}
				text1.remove();
				text2.remove();
				text3.remove();
				pics = new Picture6Select(main, s.toLowerCase());	
			}
		}
		
	}

}