package  
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	import flash.text.*;
	import flash.utils.getTimer;
	
	public class slider extends MovieClip 
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
		public var textRight:TextField = new TextField();		
		public var textLeft:TextField = new TextField();
		
		public var barLoader:Loader = new Loader();
		public var barLoader1:Loader = new Loader();
		public var barSprite:Sprite = new Sprite();
		
		public var length:Number;
		public var value:Number;
		public var percentage:Number;
		public var changes:String;
		
		public var isHighlighted:Boolean = false;
		
		
		public function slider(p_main:Main,p_x:Number,p_y:Number,p_length:Number,left:String,right:String) 
		{
			//241
			main = p_main;
			length = p_length;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);			
			myLoader.load(new URLRequest(main.prefix + "assets/slider.png"));
			myLoader1.load(new URLRequest(main.prefix + "assets/sliderB-handle.png"));
			maskLoader.load(new URLRequest(main.prefix + "assets/sliderMask.png"));
			barLoader.load(new URLRequest(main.prefix + "assets/sliderC-bar.png"));
			barLoader1.load(new URLRequest(main.prefix + "assets/sliderB-bar.png"));
			barLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, drawMarker);
			
			isDragging = false;
			sprite.x = positionX;
			sprite.y = positionY;
			maskSprite.x = positionX;
			maskSprite.y = positionY;
			barSprite.x = positionX;
			barSprite.y = positionY +4;
			
			var format1:TextFormat = new TextFormat();
			format1.font="Arial";
			format1.size= 16;
			format1.align = TextFormatAlign.CENTER;
			
			textRight.width = 50;
			textRight.text = right;	
			textRight.selectable = false;		
            textRight.setTextFormat(format1);
			textRight.textColor = 0x000000;
			
			textLeft.width = 50;
			textLeft.text = left;
			textLeft.selectable = false;		
            textLeft.setTextFormat(format1);
			textLeft.textColor = 0x000000;
			
			percentage = length / sprite.x;
			main.stage.addEventListener(MouseEvent.CLICK, clickOnBar);
			main.stage.addEventListener(MouseEvent.MOUSE_MOVE, move);
			main.stage.addEventListener(MouseEvent.MOUSE_UP, move);
			main.addEventListener(Event.ENTER_FRAME, update);
			getTimer();
			changes = "";
			reset();
		}
		
		public function onLoaderReady(e:Event) :void
		{     
			barSprite.addChild(barLoader);   
			sprite.addChild(myLoader);
			maskSprite.addChild(maskLoader);
			
			main.addChild(barSprite);
			barSprite.scaleX = 1 / 241 * length;
			
			main.addChild(sprite);
			main.addChild(maskSprite);
			
			maskSprite.addEventListener(MouseEvent.MOUSE_DOWN, onMouseClick);
			maskSprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			
			textLeft.x = positionX;
			textLeft.y = positionY + 25;			
			textRight.x = positionX + length - 50;
			textRight.y = positionY + 25;			
			
			main.addChild(textRight);			
			main.addChild(textLeft);
			
			sprite.y = positionY;
		} 
		
		public function drawMarker(e:Event):void
		{
			var len:Number = barLoader.width;
			barSprite.graphics.beginFill(0x666666, 1);
			barSprite.graphics.drawRect(0, 25, 0.75, 20);
			barSprite.graphics.drawRect(len-1, 25, 0.75, 20);
			barSprite.graphics.drawRect(len / 2+0.75, 25, 0.75, 20);
			barSprite.graphics.drawRect(len / 4, 25, 0.75, 15);
			barSprite.graphics.drawRect(len / 4 * 3, 25, 0.75, 15);
			barSprite.graphics.endFill();
		}
		
		public function move(e:Event=null) :void
		{
			if (main.mouseX > positionX && main.mouseX < (positionX + length))
			if (main.mouseY > positionY - 10 && main.mouseY < positionY + 20)
			{
				if (!isHighlighted)
				{
					isHighlighted = true;
					sprite.removeChild(myLoader);
					sprite.addChild(myLoader1);
					sprite.y = positionY - 5;
					sprite.x -= 5;
					
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
					sprite.removeChild(myLoader1);
					sprite.addChild(myLoader);
					sprite.y = positionY ;
					sprite.x += 5;
					
					barSprite.removeChild(barLoader1);
					barSprite.addChild(barLoader);
				}
			}
		}
		
		public function clickOnBar(e:Event = null):void
		{
			if (main.mouseX > positionX && main.mouseX < (positionX + length))
			{
				if (main.mouseY > positionY - 10 && main.mouseY < positionY + 20)
				{
					sprite.x = main.mouseX - myLoader.width / 2 * sprite.scaleX;
					if (getTimer() - main.taskTime > 5)
					{
						recordChanges();
					}
				}
			}
		}
		
		private function recordChanges():void
		{
			changes += "*" + percentage + "@" + getTimer();
			trace(changes);
		}
		
		public function onMouseClick(e:Event) :void
		{
			isDragging = true;
			maskSprite.startDrag();
		}
		
		public function onMouseUp(e:Event) :void
		{
			if (isDragging)
			{
				recordChanges();
			}
			isDragging = false;
			maskSprite.stopDrag();
		}
		
		
		public function update(e:Event=null):void
		{
			if (main.contains(maskSprite))
			{
				main.setChildIndex(maskSprite,main.numChildren-1);
			}
			
			if (isDragging)
			{
				if (maskSprite.x + 5 < positionX)
				{
					sprite.x = positionX - 5;
				}
				else if (maskSprite.x + 10 > positionX + length)
				{
					sprite.x = positionX + length - 10;
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
			//value = value / (length);
			percentage = int(value / length * 100);	
			//percentage /= 100;
		}
		
		public function reset():void
		{
			sprite.x = positionX + length / 2 - 5;
		}
		
		
	}

}