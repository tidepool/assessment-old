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
		private var initialScale:Number = 250;
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
		
		public function Balloon(p_main:Main, p_x:Number, p_y:Number, ind:int, picStr:String, textString:String = "")
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			isResizing = false;
			scale = (800 - positionY) / 500;
			index = ind;
			
			balloonString = new Picture(main, positionX, positionY + 180, "assets/String_" + getSuffix(ind) + ".png", initialScale * scale);
			
			balloon = new Picture(main, positionX, positionY, "assets/Balloon_" + getSuffix(ind) + ".png", initialScale * scale);
			pic = new Picture(main, positionX, positionY-20, "assets/" + picStr + ".png", 150 * scale);
			control = new BarControl(main, positionX, 700, textString);
			mask = new Picture(main, positionX, positionY, "assets/Balloon_Mask.png", initialScale * scale);
			
			mask.sprite.addEventListener(MouseEvent.MOUSE_DOWN, down);
			main.stage.addEventListener(MouseEvent.MOUSE_UP, up);
		
		}
		
		public function update():void
		{
			if (control != null)
			{
				control.update();
			}
			if (main.contains(balloon.sprite) && main.contains(balloonString.sprite) && main.contains(balloon.sprite) && main.contains(pic.sprite) && main.contains(balloonString.sprite) && main.contains(mask.sprite))
			{
				if (!hasSetIndex)
				{
					//hasSetIndex = true;
					main.setChildIndex(balloon.sprite, main.numChildren - 2);
					main.setChildIndex(pic.sprite, main.numChildren - 2);
					main.setChildIndex(mask.sprite, main.numChildren - 2);
					main.setChildIndex(balloonString.sprite, main.numChildren - 6);
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
				if (scale <= 0.35)
				{
					scale = 0.35;
				}
				if (scale >= 1.15)
				{
					scale = 1.15;
				}
				if (positionY >= 625)
				{
					positionY = 625;
				}
				if (positionY <= 225)
				{
					positionY = 225;
				}
			}
			
			balloon.setLength(initialScale * scale);
			balloonString.setLength(initialScale * scale);
			mask.setLength(initialScale * scale);
			pic.setLength(125 * scale);
			
			value = (625 - positionY) / 400 * 100;
			
			pic.positionY = positionY-10;
			balloon.positionY = positionY;
			mask.positionY = positionY;
			if (index == 1 || index == 4)
			{
			balloonString.positionX = positionX - (5 * scale);
			}
			else if (index == 2)
			{				
			balloonString.positionX = positionX + (4 * scale);
			}
			else if (index == 3)
			{				
			balloonString.positionX = positionX + (15 * scale);
			}
			balloonString.positionY = positionY + (230 * scale);
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
			main.changeString += "*" + index + "-" + Math.round(value) + "@" + main.timeDiff;
			trace(main.changeString);
		}
		
		private function getSuffix(s:int):String
		{
			if (s == 1)
			{
				return "Red";
			}
			else if (s == 2)
			{
				return "Green";
			}
			else if (s == 3)
			{
				return "Blue";
			}
			else if (s == 4)
			{
				return "Pink";
			}
			else if (s == 5)
			{
				return "Yellow";
			}
			else if (s == 6)
			{
				return "White";
			}
			else
			{
				return "White";
			}
		}
	}
}