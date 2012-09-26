package
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.ui.Mouse;
	
	public class PoemSliderScreen
	{
		private var main:Main;
		private var slider:PoemSlider;
		private var label1:Label;
		private var label2:Label;
		private var label3:Label;
		private var string1:String;
		private var string2:String;
		private var string3:String;
		private var instructions:String;
		private var xmlData:String;
		
		public function PoemSliderScreen(p_main:Main, inst:String, s1:String, s2:String, s3:String, p_data:String = "poem")
		{
			main = p_main;
			instructions = inst;
			string1 = s1;
			string2 = s2;
			string3 = s3;
			xmlData = p_data;
		}
		
		public function render():void
		{
			if (xmlData == "art")
			{
				new Label(main, 800, 100, instructions, 30);
				label1 = new Label(main, 300, 300, string1, 25, 300, true);
				label2 = new Label(main, 800, 300, string2, 25, 300, true);
				label3 = new Label(main, 1300, 300, string3, 25, 300, true);
			}
			else
			{
				label1 = new Label(main, 400, 200, string1, 25, 300, true);
				label2 = new Label(main, 800, 200, string2, 25, 300, true);
				label3 = new Label(main, 1200, 200, string3, 25, 300, true);
			}
			
			slider = new PoemSlider(main, 200, 400, 1200, "");
			new NextButton(main, 800, 750);
		}
		
		public function update():void
		{
			
			var weight:Number = 0.2;
			
			label1.sprite.alpha = (1 - slider.value) + weight;
			if (slider.value >= 0.5)
			{
				label2.sprite.alpha = 1 - (slider.value - 0.5 + weight);
			}
			else
			{
				label2.sprite.alpha = 1 - (0.5 - slider.value + weight);
			}
			label3.sprite.alpha = (slider.value) + weight;
		}
		
		public function writeXML():void
		{
			
			main.changesString += "<" + xmlData + ">" + slider.changes + "</" + xmlData + ">";
			main.xmlString += "<" + xmlData + ">";
			main.xmlString += slider.percentage;
			main.xmlString += "</" + xmlData + ">";
			main.stage.removeEventListener(MouseEvent.CLICK, slider.clickOnBar);
			trace(slider.percentage);
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
	}

}