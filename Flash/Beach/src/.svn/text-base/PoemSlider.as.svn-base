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
	
	public class PoemSlider extends MovieClip
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var isDragging:Boolean;
		public var myLoader:Loader = new Loader();
		public var myLoader1:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var maskLoader:Loader = new Loader();
		public var maskSprite:Sprite = new Sprite();
		public var barLoader1:Loader = new Loader();
		public var barLoader:Loader = new Loader();
		public var barSprite:Sprite = new Sprite();
		public var length:Number;
		public var value:Number;
		public var isHighlighted:Boolean = false;
		public var changes:String = "";
		public var percentage:int;
		
		public function PoemSlider(p_main:Main, p_x:Number, p_y:Number, p_length:Number, s:String)
		{
			//241
			main = p_main;
			length = p_length;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			myLoader.load(new URLRequest(main.prefix + "assets/bottle.png"));
			myLoader1.load(new URLRequest(main.prefix + "assets/sliderB-handle.png"));
			maskLoader.load(new URLRequest(main.prefix + "assets/sliderMask.png"));
			barLoader.load(new URLRequest(main.prefix + "assets/sliderC-bar.png"));
			barLoader1.load(new URLRequest(main.prefix + "assets/sliderB-bar.png"));
			barLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, drawMarker);
			isDragging = false;
			sprite.x = positionX;
			sprite.y = positionY - 100;
			maskSprite.x = positionX;
			maskSprite.y = positionY;
			barSprite.x = positionX + 15;
			barSprite.y = positionY + 38;
			main.addEventListener(Event.ENTER_FRAME, update);
			main.stage.addEventListener(MouseEvent.CLICK, clickOnBar);
			main.taskTime = getTimer();
		}
		
		public function onLoaderReady(e:Event):void
		{
			barSprite.addChild(barLoader);
			sprite.addChild(myLoader);
			maskSprite.addChild(maskLoader);
			
			main.addChild(barSprite);
			barSprite.scaleX = 1 / 241 * length;
			
			main.addChild(sprite);
			sprite.scaleX = 0.1;
			sprite.scaleY = 0.1;
			maskSprite.scaleX = 2;
			maskSprite.scaleY = 5;
			main.addChild(maskSprite);
			
			main.stage.addEventListener(MouseEvent.MOUSE_MOVE, move);
			main.stage.addEventListener(MouseEvent.MOUSE_UP, move);
			maskSprite.addEventListener(MouseEvent.MOUSE_DOWN, onMouseClick);
			maskSprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			reset();
		} 
		
		public function drawMarker(e:Event):void
		{
			var len:Number = barLoader.width;
			barSprite.graphics.beginFill(0x666666, 1);
			barSprite.graphics.drawRect(0, 75, 0.75, 20);
			barSprite.graphics.drawRect(len, 75, 0.75, 20);
			barSprite.graphics.drawRect(len / 2, 75, 0.75, 20);
			barSprite.graphics.drawRect(len / 4, 75, 0.75, 15);
			barSprite.graphics.drawRect(len / 4 * 3, 75, 0.75, 15);
			barSprite.graphics.endFill();
		}
		public function move(e:Event = null):void
		{
			if (main.mouseX > positionX && main.mouseX < (positionX + length))
				if (main.mouseY > positionY && main.mouseY < positionY + 100)
				{
					if (!isHighlighted)
					{
						isHighlighted = true;
						sprite.y = positionY - 5;
						
						barSprite.removeChild(barLoader);
						barSprite.addChild(barLoader1);
					}
				}
				else
				{
					if (isHighlighted)
					{
						if (isDragging)
						{
							return;
						}
						isHighlighted = false;
						sprite.y = positionY;
						barSprite.removeChild(barLoader1);
						barSprite.addChild(barLoader);
					}
				}
		}
		
		private function recordChanges():void
		{
			main.timeDiff = getTimer() - main.taskTime;
			main.taskTime = getTimer();
			changes += "*" + percentage + "@" + main.timeDiff;
			trace(changes);
		}
		
		public function clickOnBar(e:Event = null):void
		{
			if (main.mouseX > positionX + 35 && main.mouseX < (positionX + length))
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
		
		public function update(e:Event = null):void
		{
			
			sprite.y = positionY;
			if (isDragging)
			{
				if (maskSprite.x + 5 < positionX)
				{
					sprite.x = positionX - 5;
				}
				else if (maskSprite.x + 5 > positionX + length)
				{
					sprite.x = positionX + length - 5;
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
			value = sprite.x + 5 - positionX;
			value = value / (length);
			percentage = value * 100;
		}
		
		public function reset():void
		{
			sprite.x = positionX + length / 2 - 5;
		}
	
	}

}