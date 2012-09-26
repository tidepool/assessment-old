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
			
			new Label(main, 200, 30, "Raise or lower the balloons according to your interests", 30, 1200);
			
			var offset:int = 0;
			strings = new Array("Achievement", "Challenge", "Independence", "Money", "Power", "Recognition", "Service to Others", "Variety");
			balloons.push(new Balloon(main, 100 + offset, 425, 1, "Hands", strings[0]));
			balloons.push(new Balloon(main, 300 + offset, 425, 2, "Math", strings[1]));
			balloons.push(new Balloon(main, 500 + offset, 425, 3, "Music", strings[2]));
			balloons.push(new Balloon(main, 700 + offset, 425, 4, "Understanding_Others", strings[3]));
			balloons.push(new Balloon(main, 900 + offset, 425, 5, "Managerial", strings[4]));
			balloons.push(new Balloon(main, 1100 + offset, 425, 6, "Office", strings[5]));
			balloons.push(new Balloon(main, 1300 + offset, 425, 7, "Managerial", strings[6]));
			balloons.push(new Balloon(main, 1500 + offset, 425, 8, "Office", strings[7]));
			main.elapsedTime = getTimer();
			changeString = "";
			/*
			background = new Loader();
			background.load(new URLRequest(main.prefix + "assets/background.jpg"));
			main.addChild(background);
			*/
		}
		
		public function update():void
		{
			for (var i:int = 0; i < balloons.length; i++)
			{
				balloons[i].update();
			}
			//trace(balloons[0].value);
			/*
			if (main.contains(background))
				main.setChildIndex(background, 0);
				*/
		}
		
		public function WriteXML():void
		{
			
			main.xmlString += "<achievement>" + Math.round(balloons[0].value) + "</achievement>";
			main.xmlString += "<challenge>" + Math.round(balloons[1].value) + "</challenge>";
			main.xmlString += "<independence>" + Math.round(balloons[2].value) + "</independence>";
			main.xmlString += "<money>" + Math.round(balloons[3].value) + "</money>";
			main.xmlString += "<power>" + Math.round(balloons[4].value) + "</power>";
			main.xmlString += "<recognition>" + Math.round(balloons[5].value) + "</recognition>";
			main.xmlString += "<service>" + Math.round(balloons[6].value) + "</service>";
			main.xmlString += "<variety>" + Math.round(balloons[7].value) + "</variety>";
		}
	}
}