package
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	import flash.utils.getTimer;
	
	public class TugSlider
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var isDragging:Boolean;
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var maskLoader:Loader = new Loader();
		public var maskSprite:Sprite = new Sprite();
		public var changes:String;		
		public var percentage:int;
		public var barLoader:Loader = new Loader();
		public var barSprite:Sprite = new Sprite();		
		public var length:Number;
		public var value:Number;
		
		public function TugSlider(p_main:Main, p_x:Number, p_y:Number, p_length:Number, s:String)
		{
			//241
			main = p_main;
			length = p_length;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			maskLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			myLoader.load(new URLRequest(main.prefix + "assets/TugOfWar/Hand1-small.png"));
			maskLoader.load(new URLRequest(main.prefix + "assets/TugOfWar/Slider/mask.png"));
			barLoader.load(new URLRequest(main.prefix + "assets/TugOfWar/Slider/bar.png"));
			barLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, drawMarker);
			
			isDragging = false;
			sprite.x = positionX;
			sprite.y = positionY;
			maskSprite.x = positionX;
			maskSprite.y = positionY;
			barSprite.x = positionX + 600;
			barSprite.y = positionY + 30;
			main.addEventListener(Event.ENTER_FRAME, update);
			main.stage.addEventListener(MouseEvent.CLICK, clickOnBar);
			changes = "";
			main.taskTime = getTimer();
		}
		
		public function onLoaderReady(e:Event):void
		{
			barSprite.addChild(barLoader);
			sprite.addChild(myLoader);
			maskSprite.addChild(maskLoader);
			
			main.addChild(barSprite);
			//	barSprite.scaleX = 1 / 160 * length;
			barSprite.scaleX = 0.92;
			barSprite.x = positionX - 40;
			
			main.addChild(sprite);
			main.addChild(maskSprite);
			sprite.scaleX = 1 / myLoader.width * 123;
			sprite.scaleY = 1 / myLoader.height * 125;
			//	barLoader.scaleX = length*1;
			//	
			maskSprite.scaleX = 1 / maskLoader.width * 140;
			maskSprite.scaleY = 1 / maskLoader.height * 140;
			if (main.contains(barSprite))
			{
				main.setChildIndex(barSprite, 0);
			}
			
			maskSprite.addEventListener(MouseEvent.MOUSE_DOWN, onMouseClick);
			maskSprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			reset();
		} 
		
		public function drawMarker(e:Event):void
		{
			var len:Number = barLoader.width * 0.92;
			barSprite.graphics.beginFill(0x666666, 1);
			barSprite.graphics.drawRect(30 + 5, 120, 4, 20);
			barSprite.graphics.drawRect(30 + len - 7, 120, 4, 20);
			barSprite.graphics.drawRect(30 + len / 2, 120, 4, 20);
			barSprite.graphics.drawRect(30 + len / 4, 120, 4, 15);
			barSprite.graphics.drawRect(30 + len / 4 * 3, 120, 4, 15);
			barSprite.graphics.endFill();
		}
		
		public function clickOnBar(e:Event = null):void
		{
			if (main.mouseX > positionX && main.mouseX < (positionX + length))
			{
				if (main.mouseY > positionY && main.mouseY < positionY + 150)
				{
					sprite.x = main.mouseX - myLoader.width / 2 * sprite.scaleX;
					if (getTimer() - main.taskTime > 5)
					{
						recordChanges();
					}
				}
			}
		}
		
		public function onMouseClick(e:Event):void
		{
			isDragging = true;
			maskSprite.startDrag();
		}
		
		public function onMouseUp(e:Event):void
		{
			if (isDragging)
			{
				recordChanges();
			}
			isDragging = false;
			maskSprite.stopDrag();
		}
		
		private function recordChanges():void
		{
			main.timeDiff = getTimer() - main.taskTime;
			main.taskTime = getTimer();
			changes += "*" + percentage + "@" + main.timeDiff;
			trace(changes);
		}
		
		public function update(e:Event = null):void
		{
			
			sprite.y = positionY;
			if (isDragging)
			{
				if (maskSprite.x + myLoader.width / 2 * sprite.scaleX < positionX)
				{
					sprite.x = positionX - myLoader.width / 2 * sprite.scaleX;
				}
				else if (maskSprite.x + myLoader.width / 2 * sprite.scaleX > positionX + length)
				{
					sprite.x = positionX + length - myLoader.width / 2 * sprite.scaleX;
				}
				else
				{
					sprite.x = maskSprite.x;
				}
			}
			else
			{
				maskSprite.x = sprite.x;
				maskSprite.y = sprite.y;
			}
			value = sprite.x + myLoader.width / 2 * sprite.scaleX - positionX;
			value = value / (length);
			percentage = value * 100;
		
		}
		
		public function reset():void
		{
			sprite.x = positionX + length / 2 - 35;
		}
	
	}

}