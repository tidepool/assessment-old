package
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.ui.Mouse;
	import flash.utils.getTimer;
	
	public class PlacesSelect
	{
		public var main:Main;
		private var lifeGuard:placeKit;
		private var pier:placeKit;
		
		public function PlacesSelect(p_main:Main)
		{
			main = p_main;
		}
		
		public function render():void
		{
			new Label(main, 800, 100, "Choose one place to go", 30, 800, true);
			lifeGuard = new placeKit(main, 500, 400, "assets/Places/lifeguard.jpg", "");
			pier = new placeKit(main, 1100, 400, "assets/Places/pier.jpg", "");
			main.taskTime = getTimer();
		}
		
		public function update():void
		{
		
		}
		
		public function writeXML():void
		{
			main.xmlString += "</selection>";
			main.changesString += "</selection>";
			main.changesString += "<places><place>" + main.timeDiff + "</place>";
			main.xmlString += "<places>";
			if (lifeGuard.isSelected)
			{
				main.xmlString += "<place>lifeguard</place>";
			}
			else if (pier.isSelected)
			{
				main.xmlString += "<place>pier</place>";
			}
			else
			{
				main.xmlString += "<place>ERROR</place>";
			}
			trace(main.changesString);
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
	}

}