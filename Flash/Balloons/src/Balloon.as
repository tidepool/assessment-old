package
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.utils.getTimer;
	
	public class Balloon
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var scale:Number;
		public var value:Number;
		
		private var balloon:Picture;
		private var mask:Picture;
		private var pic:Picture;
		private var balloonString:Picture;
		private var isMouseIn:Boolean;
		private var hasSetIndex:Boolean = false;
		private var control:BarControl;
		private var originalY:Number;
		private var diff:Number;
		private var isResizing:Boolean;
		private var index:int;
		
		public function Balloon(p_main:Main, p_x:Number, p_y:Number, ind:int, textString:String = "")
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			isResizing = false;
			scale = positionY / 500;
			index = ind;
			
			balloonString = new Picture(main, positionX - 5, positionY + 155, "assets/Balloon_String.png", 200 * scale);
			
			balloon = new Picture(main, positionX, positionY, "assets/Balloon_" + getSuffix(ind) + ".png", 200 * scale);
			pic = new Picture(main, positionX, positionY, "assets/" + ind + ".png", 100 * scale);
			control = new BarControl(main, this, positionX, 715, textString);
			mask = new Picture(main, positionX, positionY, "assets/Mask.png", 200 * scale);
			
			mask.sprite.addEventListener(MouseEvent.MOUSE_DOWN, down);
			main.stage.addEventListener(MouseEvent.MOUSE_UP, up);
		
		}
		
		public function update():void
		{
			if (control != null)
			{
				control.update();
			}
			if (main.contains(balloon.sprite) && main.contains(pic.sprite) && main.contains(balloonString.sprite) && main.contains(mask.sprite))
			{
				if (!hasSetIndex)
				{
					hasSetIndex = true;
					main.setChildIndex(balloon.sprite, main.numChildren - 2);
					main.setChildIndex(pic.sprite, main.numChildren - 2);
					main.setChildIndex(mask.sprite, main.numChildren - 2);
					main.setChildIndex(balloonString.sprite, main.numChildren - 3);
				}
			}
			
			if (isResizing)
			{
				var tempPos:Number = main.mouseY;
				positionY = main.mouseY + diff;
				scale = (800 - positionY) / 500;
				//trace(diff);
				//trace(tempPos);
				//trace(positionY);
				if (scale <= 0.3)
				{
					scale = 0.3;
				}
				if (scale >= 1.2)
				{
					scale = 1.2;
				}
				if (positionY >= 650)
				{
					positionY = 650;
				}
				if (positionY <= 200)
				{
					positionY = 200;
				}
			}
			
			balloon.setLength(200 * scale);
			balloonString.setLength(200 * scale);
			mask.setLength(200 * scale);
			pic.setLength(100 * scale);
			
			value = (650 - positionY) / 450 * 100;
			
			pic.positionY = positionY;
			balloon.positionY = positionY;
			mask.positionY = positionY;
			balloonString.positionX = positionX - (5 * scale);
			balloonString.positionY = positionY + (190 * scale);
		}
		
		private function down(e:Event):void
		{
			isResizing = true;
			originalY = positionY;
			diff = originalY - main.mouseY;
		}
		
		private function up(e:Event):void
		{
			if (isResizing)
			{
				recordChanges();
			}
			isResizing = false;
		}
		
		private function recordChanges():void
		{
			main.timeDiff = getTimer() - main.elapsedTime;
			main.elapsedTime = getTimer();
			main.changeString +=  "*"+index + "-" + Math.round(value) + "@" + main.timeDiff;
			trace(main.changeString);
		}
		
		private function getSuffix(s:int):String
		{
			if (s == 1)
			{
				return "Blue";
			}
			else if (s == 2)
			{
				return "LimeGreen";
			}
			else if (s == 3)
			{
				return "Pink";
			}
			else if (s == 4)
			{
				return "Orange";
			}
			else if (s == 5)
			{
				return "Red";
			}
			else if (s == 6)
			{
				return "Turqoise";
			}
			else if (s == 7)
			{
				return "Purple";
			}
			else if (s == 8)
			{
				return "Green";
			}
			else if (s == 9)
			{
				return "Yellow";
			}
			else
			{
				return "Yellow";
			}
		}
	}
}