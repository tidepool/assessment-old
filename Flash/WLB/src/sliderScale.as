package
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.*;
	import flash.net.URLRequest;
	import flash.utils.getTimer;
	
	public class sliderScale extends MovieClip
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var isDragging:Boolean;
		public var myLoader:Loader = new Loader();
		public var myLoader1:Loader = new Loader();
		public var myLoader2:Loader = new Loader();
		public var myLoader3:Loader = new Loader();
		public var myLoader4:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var maskLoader:Loader = new Loader();
		public var maskSprite:Sprite = new Sprite();
		public var barLoader:Loader = new Loader();
		public var barLoader1:Loader = new Loader();
		public var barSprite:Sprite = new Sprite();
		public var length:Number;
		public var value:Number;
		public var scale:Number;
		public var text:label;
		public var isHighlighted:Boolean = false;
		public var changes:String;
		public var percentage:int;
		
		public function sliderScale(p_main:Main, p_x:Number, p_y:Number, p_length:Number, s:String)
		{
			//241
			main = p_main;
			length = p_length;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			maskLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			myLoader.load(new URLRequest(s));
			maskLoader.load(new URLRequest(main.prefix + "assets/mask.png"));
			barLoader.load(new URLRequest(main.prefix + "assets/sliderC-bar.png"));
			barLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, drawMarker);
			barLoader1.load(new URLRequest(main.prefix + "assets/sliderB-bar.png"));
			
			value = 0.5;
			isDragging = false;
			sprite.x = positionX;
			sprite.y = positionY;
			maskSprite.x = positionX;
			maskSprite.y = positionY;
			barSprite.x = positionX;
			barSprite.y = positionY + 8;
			text = new label(main, 0, 0, "");
			changes = "";
		}
		
		public function onLoaderReady(e:Event):void
		{
			barSprite.addChild(barLoader);
			sprite.addChild(myLoader);
			maskSprite.addChild(maskLoader);
			
			main.addChild(barSprite);
			barSprite.scaleX = 1 / 241 * length;
			
			main.addChild(sprite);
			main.addChild(maskSprite);
			scale = 1;
			sprite.scaleX = scale;
			sprite.scaleY = scale;
			maskSprite.scaleX = 1 / maskLoader.width * myLoader.width * scale;
			maskSprite.scaleY = 1 / maskLoader.height * myLoader.height * scale;
			
			main.stage.addEventListener(MouseEvent.MOUSE_MOVE, move);
			main.stage.addEventListener(MouseEvent.MOUSE_UP, move);
			main.stage.addEventListener(MouseEvent.CLICK, clickOnBar);
			
			maskSprite.addEventListener(MouseEvent.MOUSE_DOWN, onMouseClick);
			maskSprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			value = 0.5;
			reset();
			value = 0.5;
			reset();		
		}
		
		public function removeListeners():void
		{			
			main.stage.removeEventListener(MouseEvent.MOUSE_MOVE, move);
			main.stage.removeEventListener(MouseEvent.MOUSE_UP, move);
			main.stage.removeEventListener(MouseEvent.CLICK, clickOnBar);			
		}
		
		public function drawMarker(e:Event):void
		{
			var len:Number = barLoader.width + 1;
			barSprite.graphics.beginFill(0x666666, 1);
			barSprite.graphics.drawRect(0, 25, 0.75, 20);
			barSprite.graphics.drawRect(len - 2, 25, 0.75, 20);
			barSprite.graphics.drawRect(len / 2, 25, 0.75, 20);
			barSprite.graphics.drawRect(len / 4, 25, 0.75, 15);
			barSprite.graphics.drawRect(len / 4 * 3, 25, 0.75, 15);
			barSprite.graphics.endFill();
		}
		
		public function move(e:Event = null):void
		{
			if (main.mouseX > positionX && main.mouseX < (positionX + length))
				if (main.mouseY > positionY - 50 && main.mouseY < positionY + 50)
				{
					if (!isHighlighted)
					{
						isHighlighted = true;
						
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
						
						barSprite.removeChild(barLoader1);
						barSprite.addChild(barLoader);
					}
				}
		}
		
		public function clickOnBar(e:Event = null):void
		{
			if (main.mouseX > positionX && main.mouseX < (positionX + length))
			{
				if (main.mouseY > positionY - 50 && main.mouseY < positionY + 50)
				{
					maskSprite.x = main.mouseX - maskLoader.width / 2 * maskSprite.scaleX;
					if (maskSprite.x + myLoader.width * scale / 2 < positionX)
					{
						sprite.x = positionX - myLoader.width * scale / 2;
					}
					else if (maskSprite.x + myLoader.width * scale / 2 > positionX + length)
					{
						sprite.x = positionX + length - myLoader.width * scale / 2;
					}
					else
					{
						sprite.x = maskSprite.x;
					}
					value = sprite.x + myLoader.width * scale / 2 - positionX;
					value = value / (length);
					percentage = value * 100;
					isDragging = true;
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
			maskSprite.scaleX = 1 / maskLoader.width * myLoader.width * scale;
			maskSprite.scaleY = 1 / maskLoader.height * myLoader.height * scale;
		}
		
		private function recordChanges():void
		{
			changes += "*" + percentage + "@" + main.getTime();
			trace(changes);
		}
		
		public function update():void
		{
			
			if (main.contains(maskSprite))
				main.setChildIndex(maskSprite, main.numChildren - 1);
			sprite.y = positionY - myLoader.height * scale / 2;
			if (isDragging)
			{
				if (maskSprite.x + myLoader.width * scale / 2 < positionX)
				{
					sprite.x = positionX - myLoader.width * scale / 2;
				}
				else if (maskSprite.x + myLoader.width * scale / 2 > positionX + length)
				{
					sprite.x = positionX + length - myLoader.width * scale / 2;
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
			value = sprite.x + myLoader.width * scale / 2 - positionX;
			value = value / (length);
			percentage = value * 100;
			scale = value / 2 + 0.5;
			sprite.scaleX = scale;
			sprite.scaleY = scale;
		
		}
		
		public function reset():void
		{
			scale = value / 2 + 0.5;
			sprite.x = positionX + length / 2 - myLoader.width * scale / 2;
		}
	}

}