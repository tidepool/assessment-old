package  
{
	import flash.events.*;
	import flash.ui.Keyboard;
	
	public class Shiva 
	{
		public var main:Main;
		public var s:sliderCustom;
		private var l:label;
		
		public function Shiva(p_main:Main) 
		{
			main = p_main;
		}
		
		public function render():void
		{
			l = new label(main, 400, 50, "How many hours do you work each week? Move the slider to select the appropriate number of hours.");
			s = new sliderCustom(main, 250, 400, 1100, "< 20","> 66");
			main.getTime();
		}
		
		public function update():void
		{
			s.update();
		}
		
		public function keyPress():void
		{
			
		}
		
		public function writeXML():void
		{			
			main.changesString += "<shiva>" + s.changes + "</shiva>";
			main.xmlString += "<shiva>" + s.percentage + "</shiva>";
			main.stage.removeEventListener(MouseEvent.CLICK, s.clickOnBar);
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
	}

}