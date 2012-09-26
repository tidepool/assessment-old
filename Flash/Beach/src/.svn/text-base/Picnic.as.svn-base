package
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.ui.Mouse;
	import flash.utils.getTimer;
	import flash.utils.Timer;
	
	public class Picnic
	{
		public var main:Main;
		public var shouldDisplayPlate:Boolean = true;
		public var plate:picture;
		public var next:NextButton;
		
		public var noPic:HandPic;
		public var sometimesPic:HandPic;
		public var yesPic:HandPic;
		
		public var questionString:String;
		public var foodURL:String;
		public var xmlData:String;
		public var isSelected:Boolean = false;
		private var elapsedTime:Number;
		
		public function Picnic(p_main:Main, p_questionString:String, p_foodURL:String, p_data:String = "food")
		{
			main = p_main;
			questionString = p_questionString;
			foodURL = p_foodURL;
			xmlData = p_data;
			elapsedTime = 0;
		}
		
		public function render():void
		{
			new Label(main, 800, 100, questionString, 30, 1000, true);
			//	next = new nextButton(main, 650, 700);
			plate = new picture(main, main.mouseX, main.mouseY, "assets/Picnic/plate-mouse.png", 150);
			showplate();
			noPic = new HandPic(main, 300, 400, "assets/Picnic/hand.png", 300, this, "No", 0);
			sometimesPic = new HandPic(main, 800, 400, "assets/Picnic/hand2.png", 300, this, "Sometimes", 0);
			yesPic = new HandPic(main, 1300, 400, "assets/Picnic/hand3.png", 300, this, "Yes", 0);
			main.taskTime = getTimer();
		}
		
		public function update():void
		{
			if (shouldDisplayPlate)
			{
				plate.setPosition(main.mouseX, main.mouseY);
			}
			
			if (getTimer() - elapsedTime > 500 && elapsedTime != 0)
			{
				elapsedTime = 0;
				displayNext();
			}
		}
		
		public function selected():void
		{
			elapsedTime = getTimer();
		}
		
		public function hideplate(e:Event = null):void
		{
			shouldDisplayPlate = false;
			if (main.contains(plate.sprite))
			{
				main.removeChild(plate.sprite);
			}
			Mouse.show();
		}
		
		public function showplate(e:Event = null):void
		{
			shouldDisplayPlate = true;
			if (!main.contains(plate.sprite))
			{
				main.addChild(plate.sprite);
			}
			Mouse.hide();
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
		
		public function writeXML():void
		{
			main.changesString += "<p>" + main.timeDiff + "</p>";
			main.xmlString += "<" + xmlData + ">";
			if (yesPic.isSelected)
			{
				main.xmlString += "y";
			}
			else if (noPic.isSelected)
			{
				main.xmlString += "n";
			}
			else if (sometimesPic.isSelected)
			{
				main.xmlString += "s";
			}
			main.xmlString += "</" + xmlData + ">";
			trace(main.changesString);
		}
	}

}