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
	/**
	 * ...
	 * @author wei
	 */
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
		
		public var isHighlighted:Boolean = false;
		
		
		public function slider(p_main:Main,p_x:Number,p_y:Number,p_length:Number,left:String,right:String) 
		{
			//241
			main = p_main;
			length = p_length;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + "assets/slider.png");
			
			myLoader.load(fileRequest);
			fileRequest = new URLRequest(main.prefix + "assets/sliderB-handle.png");
			myLoader1.load(fileRequest);
			
			fileRequest = new URLRequest(main.prefix + "assets/sliderMask.png");
			maskLoader.load(fileRequest);
			
			fileRequest = new URLRequest(main.prefix + "assets/sliderC-bar.png");
			barLoader.load(fileRequest);
			fileRequest = new URLRequest(main.prefix + "assets/sliderB-bar.png");
			barLoader1.load(fileRequest);
			
			isDragging = false;
			sprite.x = positionX;
			sprite.y = positionY;
			maskSprite.x = positionX;
			maskSprite.y = positionY;
			barSprite.x = positionX+4;
			barSprite.y = positionY ;
			
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
			
			percentage = length / sprite.y;
			main.stage.addEventListener(MouseEvent.CLICK, clickOnBar);
			main.stage.addEventListener(MouseEvent.MOUSE_MOVE, move);
			main.stage.addEventListener(MouseEvent.MOUSE_UP, move);
			main.addEventListener(Event.ENTER_FRAME, update);
			
			
		}
		
		public function onLoaderReady(e:Event) :void
		{     
			barSprite.addChild(barLoader);   
			sprite.addChild(myLoader);
			maskSprite.addChild(maskLoader);
			
			main.addChild(barSprite);
			barSprite.scaleY = 1 / 241 * length;
			
			main.addChild(sprite);
			main.addChild(maskSprite);
			
			maskSprite.addEventListener(MouseEvent.MOUSE_DOWN, onMouseClick);
			maskSprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			
			textLeft.y = positionY;
			textLeft.x = positionX + 25;			
			textRight.y = positionY + length - 50;
			textRight.x = positionX + 25;			
			
			main.addChild(textRight);			
			main.addChild(textLeft);
			
			sprite.x = positionX;
		} 
		
		
		public function move(e:Event=null) :void
		{
			if (main.mouseY > positionY && main.mouseY < (positionY + length))
			if (main.mouseX > positionX - 10 && main.mouseX < positionX + 20)
			{
				if (!isHighlighted)
				{
					isHighlighted = true;
					sprite.removeChild(myLoader);
					sprite.addChild(myLoader1);
					sprite.x = positionX - 5;
					sprite.y -= 5;
					
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
					sprite.x = positionX ;
					sprite.y += 5;
					
					barSprite.removeChild(barLoader1);
					barSprite.addChild(barLoader);
				}
			}
		}
		
		public function clickOnBar(e:Event=null) :void
		{
			if (main.mouseY > positionY && main.mouseY < (positionY + length))
			if(main.mouseX>positionX-10&&main.mouseX< positionX+20)
			sprite.y = main.mouseY-myLoader.height/2*sprite.scaleY;
		}
		
		public function onMouseClick(e:Event) :void
		{
			isDragging = true;
			maskSprite.startDrag();
		}
		
		public function onMouseUp(e:Event) :void
		{
			isDragging = false;
			maskSprite.stopDrag();
		}
		
		
		public function update(e:Event=null):void
		{
			trace(percentage);
			if (main.contains(maskSprite))
			{
				main.setChildIndex(maskSprite,main.numChildren-1);
			}
			
			if (isDragging)
			{
				if (maskSprite.y + 5 < positionY)
				{
					sprite.y = positionY - 5;
				}
				else if (maskSprite.y + 10 > positionY + length)
				{
					sprite.y = positionY + length - 10;
				}
				else
				{
					sprite.y = maskSprite.y;
				}
			}
			else
			{
				maskSprite.y = sprite.y;
				maskSprite.x = sprite.x;
			}
			
			value = sprite.y + 5 - positionY;
			//value = value / (length);
			percentage = int(value / length * 100);	
			
		}
		
		public function reset():void
		{
			sprite.y = positionY + length / 2 - 5;
		}
		
		
	}

}