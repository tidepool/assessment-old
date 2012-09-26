package
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.display.StageScaleMode;
	import flash.events.*;
	import flash.net.*;
	import flash.external.*;
	import flash.utils.getTimer;
	
	public class BalloonMain
	{
		public var balloons:Array = new Array();
		public var timeDiff:Number;
		public var changeString:String;
		
		private var main:Main;
		private var strings:Array;
		
		public function BalloonMain(m:Main, type:int):void
		{
			main = m;
			
			new Label(main, 200, 30, "Raise or lower the balloons according to your interests", 30, 1200,1,0x333333);
			
			var offset:int = 20;
			if (type == 1)
			{
				strings = new Array("Working With My Hands", "Math Ability", "Musical Ability", "Understanding of Others", "Managerial Skills", "Office Skills");
				balloons.push(new Balloon(main, 150 + offset, 425, 1, "Hands", strings[0]));
				balloons.push(new Balloon(main, 400 + offset, 425, 2, "Math", strings[1]));
				balloons.push(new Balloon(main, 650 + offset, 425, 3, "Music", strings[2]));
				balloons.push(new Balloon(main, 900 + offset, 425, 4, "Understanding_Others", strings[3]));
				balloons.push(new Balloon(main, 1150 + offset, 425, 5, "Managerial", strings[4]));
				balloons.push(new Balloon(main, 1400 + offset, 425, 6, "Office", strings[5]));
			}
			else if (type == 2)
			{
				strings = new Array("Mechanical Ability", "Scientific Ability", "Artistic Ability", "Teaching Ability", "Sales Ability", "Clerical Ability");
				balloons.push(new Balloon(main, 150 + offset, 425, 1, "Mechanical", strings[0]));
				balloons.push(new Balloon(main, 400 + offset, 425, 2, "Science", strings[1]));
				balloons.push(new Balloon(main, 650 + offset, 425, 3, "Artistic", strings[2]));
				balloons.push(new Balloon(main, 900 + offset, 425, 4, "Teaching", strings[3]));
				balloons.push(new Balloon(main, 1150 + offset, 425, 5, "Sales", strings[4]));
				balloons.push(new Balloon(main, 1400 + offset, 425, 6, "Clerical", strings[5]));
			}
			
			main.elapsedTime = getTimer();
			changeString = "";
		}
		
		public function update():void
		{
			for (var i:int = 0; i < balloons.length; i++)
			{
				balloons[i].update();
			}
			//trace(balloons[0].value);
		}
		
		public function WriteXML():void
		{
			main.xmlString += "<set1>" + Math.round(balloons[0].value) + "</set1>";
			main.xmlString += "<set2>" + Math.round(balloons[1].value) + "</set2>";
			main.xmlString += "<set3>" + Math.round(balloons[2].value) + "</set3>";
			main.xmlString += "<set4>" + Math.round(balloons[3].value) + "</set4>";
			main.xmlString += "<set5>" + Math.round(balloons[4].value) + "</set5>";
			main.xmlString += "<set6>" + Math.round(balloons[5].value) + "</set6>";
			//main.xmlString += "<set7>" + changeString + "</changes>";
		}
	}
}