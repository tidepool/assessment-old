package
{
	import flash.events.*;
	import flash.ui.Keyboard;
	
	public class Travel
	{
		public var main:Main;
		public var s:Array = new Array();
		private var instructions:label;
		private var numbers:label;
		
		public function Travel(p_main:Main)
		{
			main = p_main;
		}
		
		public function render():void
		{
			instructions = new label(main, 100, 20, "How much do you travel for work, using the vehicle below?", 30);
			instructions.changeWidth(1400);
			new label(main, 0, 400, "Rarely", 35, 300);
			new label(main, 1315, 400, "Constantly", 35, 300);
			s.push(new sliderScale(main, 250, 225, 1100, "assets/Travel/airplane.png"));
			s.push(new sliderScale(main, 250, 375, 1100, "assets/Travel/car.png"));
			s.push(new sliderScale(main, 250, 525, 1100, "assets/Travel/boat.png"));
			s.push(new sliderScale(main, 250, 675, 1100, "assets/Travel/train.png"));
			main.getTime();
		}
		
		public function update():void
		{
			for (var i:int = 0; i < s.length; i++)
			{
				s[i].update();
			}
		}
		
		public function keyPress():void
		{
		
		}
		
		public function writeXML():void
		{
			main.xmlString += "<travel>";
			main.xmlString += "<plane>" + s[0].percentage + "</plane>";
			main.xmlString += "<car>" + s[1].percentage + "</car>";
			main.xmlString += "<boat>" + s[2].percentage + "</boat>";
			main.xmlString += "<train>" + s[3].percentage + "</train>";
			main.xmlString += "</travel>";
			
			main.changesString += "<travel>";
			main.changesString += "<plane>" + s[0].changes + "</plane>";
			main.changesString += "<car>" + s[1].changes + "</car>";
			main.changesString += "<boat>" + s[2].changes + "</boat>";
			main.changesString += "<train>" + s[3].changes + "</train>";
			main.changesString += "</travel>";
			for (var i:int = 0; i < 4; i++)
			{
				s[i].removeListeners();
			}
		}
		
		public function displayNext():void
		{
			
			for (var i:int = 0; i < s.length; i++)
			{
				if (!main.contains(s[i].sprite))
				{
					return;
				}
			}
			main.displayNext();
		}
	}

}