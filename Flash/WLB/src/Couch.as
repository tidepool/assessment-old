package
{
	import flash.events.*;
	import flash.ui.Keyboard;
	
	public class Couch
	{
		public var main:Main;
		public var couch:sliderScale;
		private var instructions:label;
		
		public function Couch(p_main:Main)
		{
			main = p_main;
		}
		
		public function render():void
		{
			instructions = new label(main, 300, 50, "How much leisure time do you have compared to your ideal?");
			new label(main, 1300, 600, "More", 35, 100);
			new label(main, 200, 600, "Less", 35, 100);
			instructions.changeWidth(1000);
			//	new label(main,160,100,"   1\t\t\t2\t\t\t3\t\t\t4\t\t\t5\t\t\t6\t\t\t7",35,1200);
			couch = new sliderScale(main, 200, 400, 1200, "assets/Couch/Couch.png");
			main.getTime();
		}
		
		public function update():void
		{
			couch.update();
		}
		
		public function keyPress():void
		{
		
		}
		
		public function writeXML():void
		{
			main.changesString += "<couch>" + couch.changes + "</couch>";
			main.changesString += "<nets>";
			main.xmlString += "<couch>" + couch.percentage + "</couch>";
			main.xmlString += "<nets>";
			main.stage.removeEventListener(MouseEvent.MOUSE_MOVE, couch.move);
			main.stage.removeEventListener(MouseEvent.MOUSE_UP, couch.move);
			main.stage.removeEventListener(MouseEvent.CLICK, couch.clickOnBar);
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
	}

}