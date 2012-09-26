package
{
	import flash.events.KeyboardEvent;
	import flash.ui.Keyboard;
	import flash.events.MouseEvent;
	
	public class TugOfWar
	{
		public var main:Main;
		public var s:Array = new Array();
		public var question:String;
		public var pic1URL:String;
		public var pic2URL:String;
		public var pic3URL:String;
		public var str1:String;
		public var str2:String;
		public var str3:String;
		public var peoplePos:Number;
		public var slider:TugSlider;
		public var xmlData:String;
		public var pic1:picture;
		public var pic2:picture;
		public var pic3:picture;
		
		public function TugOfWar(p_main:Main, p_ques:String, url1:String, url2:String, url3:String, s1:String, s2:String, s3:String, pos:Number = 800, p_data:String = "tug")
		{
			main = p_main;
			question = p_ques;
			pic1URL = url1;
			pic2URL = url2;
			pic3URL = url3;
			str1 = s1;
			str2 = s2;
			str3 = s3;
			peoplePos = pos;
			xmlData = p_data;
		}
		
		public function render():void
		{
			new NextButton(main, 800, 750);
			
			slider = new TugSlider(main, 230, 450, 1100, "");
			
			new Label(main, 800, 50, question, 35, 800, true);
			
			pic1 = new picture(main, 300, 220, pic1URL, 200);
			pic2 = new picture(main, 800, 220, pic2URL, 200);
			pic3 = new picture(main, 1300, 220, pic3URL, 200);
			
			new Label(main, 300, 350, str1, 20, 200, true);
			new Label(main, 800, 350, str2, 20, 200, true);
			new Label(main, 1300, 350, str3, 20, 200, true);
		}
		
		public function writeXML():void
		{
			//main.changesString += slider.changes + "|";
			main.xmlString += "<" + xmlData + ">";
			var temp:int = slider.value * 100;
			main.xmlString += temp;
			main.xmlString += "</" + xmlData + ">";
			main.changesString += "<" + xmlData + ">" + slider.changes + "</" + xmlData + ">";
			trace(main.changesString);
			main.stage.removeEventListener(MouseEvent.CLICK, slider.clickOnBar);
		}
		
		public function update():void
		{
			//trace(slid.value);
			var weight:Number = 0.2;
			pic1.sprite.alpha = (1 - slider.value) + weight;
			if (slider.value >= 0.5)
			{
				pic2.sprite.alpha = 1 - (slider.value - 0.5 + weight);
			}
			else
			{
				pic2.sprite.alpha = 1 - (0.5 - slider.value + weight);
			}
			pic3.sprite.alpha = (slider.value) + weight;
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
	}

}