package
{
	import flash.events.KeyboardEvent;
	import flash.ui.Keyboard;
	import flash.events.MouseEvent;
	
	public class PlacesSliderScreen
	{
		public var main:Main;
		public var s:Array = new Array();
		public var question:String;
		public var url:String;
		public var slider:PlacesSlider;
		public var xmlData:String;
		
		public function PlacesSliderScreen(p_main:Main, p_ques:String, p_url:String, p_data:String = "slider")
		{
			main = p_main;
			question = p_ques;
			url = p_url;
			xmlData = p_data;
		}
		
		public function render():void
		{
			new NextButton(main, 800, 750);
			slider = new PlacesSlider(main, 200, 500, 1200, "", "", this);
			new Label(main, 800, 100, question, 30, 1200, true);
			new Label(main, 200, 600, "Never", 25, 800, true);
			new Label(main, 1400, 600, "Always", 25, 800, true);
			new picture(main, 800, 300, url, 450);
		}
		
		public function writeXML():void
		{
			main.changesString += "<" + xmlData + ">" + slider.changes + "</" + xmlData + ">";
			main.xmlString += "<" + xmlData + ">";
			var temp:int = slider.percentage;
			main.xmlString += temp;
			main.xmlString += "</" + xmlData + ">";
			main.stage.removeEventListener(MouseEvent.CLICK, slider.clickOnBar);
			trace(temp);
		}
		
		public function update():void
		{
		
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
	}

}