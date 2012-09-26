package  
{
	import flash.events.KeyboardEvent;
	import flash.ui.Keyboard;
	import flash.utils.getTimer;
	
	public class PrimingScreen 
	{
		public var main:Main;
		public var startTime:Number;
		public var texts:Array;
		
		public function PrimingScreen(p_main:Main,p_s:String="Moon") 
		{
			main = p_main;
			texts = new Array();
		}
		
		public function render():void
		{
			main.graphics.beginFill(0x0000FF, 1);
			main.graphics.drawCircle(500, 500, 2000);
			main.graphics.endFill();
			texts.push(new Label(main, 800-200,500-450, "08267"));
			texts.push(new Label(main, 800+100,500-430, "JEZEBEL"));
			texts.push(new Label(main, 800-250,500-300, "KREDG"));
			texts.push(new Label(main, 800+200,500-250, "9922"));
			texts.push(new Label(main, 800-300,500-100, "PIDETOOL"));
			texts.push(new Label(main, 800+300,500+150, "H89WJA6"));
			texts.push(new Label(main, 800-450,500+250, "ERRIR"));
			texts.push(new Label(main, 800-200,500+350, "ILIKEITSUBLIMINAL"));
			startTime = getTimer();
		}
		
		public function update():void
		{
			if (getTimer() - startTime > 100)
			{
				for (var i:int = 0; i < texts.length; i++ )
				{
					texts[i].remove();
				}
				main.displayNext();
			}
		}
		
		
		public function writeXML():void
		{
		}
		
		
		public function keyPress():void
		{
			
		}
		
	}

}