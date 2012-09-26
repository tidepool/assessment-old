package
{
	import adobe.utils.CustomActions;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.net.URLLoader;
	
	public class BarUnit
	{		
		public var destinationX:Number;
		public var destinationLength:Number;	
		public var currX:Number;		
		
		private var main:Main;
		private var bar:MacBar;
		private var pic:Picture;
		private var mask:Picture;		
		private var positionX:Number;
		private var positionY:Number;			
		private var flag:int = 100;		
		private var hasSetIndex:Boolean = false;
		private var isDragging:Boolean = false;		
		private var color:uint;	
		private var string:String;
		
		public function BarUnit(p_main:Main, p_bar:MacBar, px:Number, py:Number, picURL:String)
		{
			main = p_main;
			bar = p_bar;
			positionX = px;
			positionY = py;
			destinationX = px;
			destinationLength = bar.unitLength;
			string = picURL.substring(7, picURL.length - 4);
			pic = new Picture(main, px, py, picURL, bar.unitLength);
			mask = new Picture(main, px, py, "assets/mask.png", bar.unitLength);
			mask.sprite.addEventListener(MouseEvent.MOUSE_DOWN, mouseDown);
			mask.sprite.addEventListener(MouseEvent.MOUSE_UP, mouseUp);
			main.stage.addEventListener(MouseEvent.MOUSE_UP, mouseUp);
			
			mask.myLoader.addEventListener(MouseEvent.MOUSE_MOVE, move);
			mask.myLoader.addEventListener(MouseEvent.MOUSE_OUT, out);
			out();
		}
		
		private function drawBorder():void
		{
			var myLoader:Loader = pic.myLoader;
			var sprite:Sprite = pic.sprite;
			sprite.graphics.clear();
			sprite.graphics.beginFill(color, 0.05);
			sprite.graphics.drawRect(myLoader.x - 10, myLoader.y - 10, myLoader.width + 20, myLoader.height + 20);
			sprite.graphics.endFill();
			sprite.graphics.beginFill(color, 0.1);
			sprite.graphics.drawRect(myLoader.x - 9, myLoader.y - 9, myLoader.width + 18, myLoader.height + 18);
			sprite.graphics.endFill();
			sprite.graphics.beginFill(color, 0.15);
			sprite.graphics.drawRect(myLoader.x - 8, myLoader.y - 8, myLoader.width + 16, myLoader.height + 16);
			sprite.graphics.endFill();
			sprite.graphics.beginFill(color, 0.2);
			sprite.graphics.drawRect(myLoader.x - 7, myLoader.y - 7, myLoader.width + 14, myLoader.height + 14);
			sprite.graphics.endFill();
			sprite.graphics.beginFill(color, 0.25);
			sprite.graphics.drawRect(myLoader.x - 6, myLoader.y - 6, myLoader.width + 12, myLoader.height + 12);
			sprite.graphics.endFill();
			sprite.graphics.beginFill(color, 0.3);
			sprite.graphics.drawRect(myLoader.x - 5, myLoader.y - 5, myLoader.width + 10, myLoader.height + 10);
			sprite.graphics.endFill();
			sprite.graphics.beginFill(color, 0.35);
			sprite.graphics.drawRect(myLoader.x - 4, myLoader.y - 4, myLoader.width + 8, myLoader.height + 8);
			sprite.graphics.endFill();
			sprite.graphics.beginFill(color, 0.4);
			sprite.graphics.drawRect(myLoader.x - 3, myLoader.y - 3, myLoader.width + 6, myLoader.height + 6);
			sprite.graphics.endFill();
			sprite.graphics.beginFill(color, 0.45);
			sprite.graphics.drawRect(myLoader.x - 2, myLoader.y - 2, myLoader.width + 4, myLoader.height + 4);
			sprite.graphics.beginFill(color, 0.5);
			sprite.graphics.drawRect(myLoader.x - 1, myLoader.y - 1, myLoader.width + 2, myLoader.height + 2);
			sprite.graphics.endFill();
		}
		
		public function update():void
		{
			drawBorder();
			pic.update();
			currX = pic.sprite.x;
			updateMaskScale();
			pic.positionX = (destinationX - pic.positionX) / 7 + pic.positionX;
			pic.setLength(pic.length + (destinationLength - pic.length) / 7);
			
			if (isDragging)
			{
				main.setChildIndex(pic.sprite, main.numChildren - 1);
				main.setChildIndex(mask.sprite, main.numChildren - 1);
				pic.setLength(bar.maxScale * bar.unitLength);
				pic.setPosition(mask.getPositionX(), pic.positionY);
			}
			else
			{
				mask.setPosition(pic.getPositionX(), pic.positionY);
			}
			
			if (main.contains(pic.sprite) && main.contains(mask.sprite))
			{
				if (!hasSetIndex)
				{
					main.setChildIndex(mask.sprite, main.numChildren - 1);
					hasSetIndex = true;
				}
			}
		
		}
		
		private function updateMaskScale():void
		{
			mask.setLengthXY(pic.getLengthX(), pic.getLengthY());
		}
		
		private function mouseDown(e:Event):void
		{
			mask.sprite.startDrag();
			isDragging = true;
			bar.isDragging = true;
			bar.trackClick(string);
			bar.populateStrings();
		}
		
		public function remove():void
		{
			main.removeChild(pic.sprite);
		}
		
		public function getString():String
		{			
			return string;
		}
		
		private function mouseUp(e:Event):void
		{
			if (isDragging)
			{
				if (bar.compareUnits())
				{
					trace("Same order");
					bar.trackSetDown();
				}
				else
				{
					trace("Different order");
					bar.changes++;
					bar.trackChange();
				}
			}
			mask.sprite.stopDrag();
			isDragging = false;
			bar.isDragging = false;
		}
		
		private function move(e:Event = null):void
		{
			//sprite.alpha = 1;
			color = 0x0000ff
		}
		
		private function out(e:Event = null):void
		{
			//sprite.alpha = 1;
			color = 0xFFFFFF
		}
	}

}