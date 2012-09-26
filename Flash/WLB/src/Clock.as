package  
{
	import flash.display.Bitmap;
	import flash.display.BitmapData;
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.geom.Rectangle;
	import flash.ui.Keyboard;
	import flash.ui.Mouse;
	
	public class Clock 
	{
		public var main:Main;
		public var clock:pictureClock;
		public var next:Option;		
		public var rad:Number;		
		public var hand:picture;		
		public var checks:Array = new Array();
		
		public var changes:String;		
		private var timeLabel:label;
		private var value:int;
		
		public function Clock(p_main:Main) 
		{
			main = p_main;
		}
		
		public function render():void
		{
			new label(main, 300, 50, "How many hours of leisure time (working out, reading, watching TV) do you have in an average day?", 35, 1000);
			timeLabel=new label(main, 800, 350, "0-1 hours of leisure time", 35, 1000);
			clock = new pictureClock(main, 796, 400, "assets/Clock/clock.png", 550);
			clock.masksprite.addEventListener(MouseEvent.CLICK, click);
			hand = new picture(main, 900, 410, "assets/Clock/hand-1.png", 200);
			rad = -Math.PI / 2;
			main.getTime();
			changes = "";
		}
		
		public function update():void
		{
			hand.sprite.rotation = rad/Math.PI*180;
			if (main.contains(hand.sprite))
			{
				main.setChildIndex(hand.sprite,main.numChildren-1);
			}
			clock.update();
			var ax:Number = 24;
			var ay:Number = 9;
			var offsetx:Number = ax*Math.cos(rad)-ay*Math.sin(rad);
			var offsety:Number = ax*Math.sin(rad)+ay*Math.cos(rad);
			hand.sprite.x = 790 -offsetx;
			hand.sprite.y = 410 -offsety;
		}
		
		
		public function writeXML():void
		{
			main.xmlString += "<clock>"+ value + "</clock>";
			main.changesString += "<clock>" + changes + "</clock>";
		}
		
		public function keyPress():void
		{
			
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
		
		public function move(e:Event):void
		{
		}
		public function out(e:Event):void
		{
		
		}
		public function click(e:Event):void
		{
			calculateRad();
			value = rad / Math.PI * 180;
			value += 90;
			if (value > 360)
			{
				value -= 360;
			}
			value = value / 360 * 12;
			trace(value);
			if (value == 12)
			{
				value = 11;
			}
			timeLabel.changeText(800, 350, 35, value + "-" + (value + 1) + " hours of leisure time");
			
			changes += "*" + value + "@" + main.getTime();
		}
		
		public function calculateRad():void
		{
			var positionX:Number = main.mouseX;
			var positionY:Number = main.mouseY;
			var originalX:Number = 790;
			var originalY:Number = 410;
			var r:Number = Math.sqrt((positionX - originalX)*(positionX - originalX)+(positionY - originalY)*(positionY - originalY));
			if (positionY - originalY == 0)
			{
				if (positionX - originalX > 0)
				{
					rad=Math.PI*2;
				}
				else
				{
					rad=Math.PI;
				}
			}
			else
			{
				
				if ((positionY - originalY) < 0)
				{
					rad=Math.acos((positionX - originalX)/r  );
				}
				else
				{
					rad=Math.PI*2-Math.acos((positionX - originalX)/ r);
				}
			}
			rad = Math.PI * 2 - rad;
			
		}


	}

}