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
	
	public class sliderCustom extends MovieClip
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var isDragging:Boolean;
		public var myLoader:Array = new Array();
		public var sprite:Sprite = new Sprite();
		public var maskLoader:Loader = new Loader();
		public var maskSprite:Sprite = new Sprite();
		public var barLoader:Loader = new Loader();
		public var barSprite:Sprite = new Sprite();
		public var length:Number;
		public var value:Number;
		public var scale:Number;
		public var textRight:TextField = new TextField();
		public var textLeft:TextField = new TextField();
		public var text:label;
		public var changes:String;
		public var percentage:int;
		
		public function sliderCustom(p_main:Main, p_x:Number, p_y:Number, p_length:Number, left:String, right:String)
		{
			//241
			main = p_main;
			length = p_length;
			positionX = p_x;
			positionY = p_y;
			for (var i:int = 0; i < 5; i++)
			{
				myLoader.push(new Loader());
			}
			myLoader[0].load(new URLRequest(main.prefix + "assets/Shiva/20 hours or fewer.png"));
			myLoader[1].load(new URLRequest(main.prefix + "assets/Shiva/21-35 hours.png"));
			myLoader[2].load(new URLRequest(main.prefix + "assets/Shiva/36-50 hours.png"));
			myLoader[3].load(new URLRequest(main.prefix + "assets/Shiva/51-65 hours.png"));
			myLoader[4].load(new URLRequest(main.prefix + "assets/Shiva/66+ hours.png"));
			myLoader[4].contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			maskLoader.load(new URLRequest(main.prefix + "assets/Shiva/mask.png"));
			barLoader.load(new URLRequest(main.prefix + "assets/bar.png"));
			barLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, drawMarker);
			
			isDragging = false;
			sprite.x = positionX;
			sprite.y = positionY;
			maskSprite.x = positionX;
			maskSprite.y = positionY;
			barSprite.x = positionX;
			barSprite.y = positionY + 8;
			text = new label(main, 0, 0, "");
			
			var format1:TextFormat = new TextFormat();
			format1.font = "Arial";
			format1.size = 22;
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
			
			changes = "";
		}
		
		public function onLoaderReady(e:Event):void
		{
			barSprite.addChild(barLoader);
			maskSprite.addChild(maskLoader);
			
			main.addChild(barSprite);
			barSprite.scaleX = 1 / 160 * length;
			
			main.addChild(sprite);
			main.addChild(maskSprite);
			scale = 1;
			sprite.scaleX = scale;
			sprite.scaleY = scale;
			maskSprite.scaleX = scale;
			maskSprite.scaleY = scale;
			
			maskSprite.addEventListener(MouseEvent.MOUSE_DOWN, onMouseClick);
			maskSprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			main.stage.addEventListener(MouseEvent.CLICK, clickOnBar);
			reset();
			
			textLeft.x = positionX - 20;
			textLeft.y = positionY + 25;
			textRight.x = positionX + length - 50 + 20;
			textRight.y = positionY + 25;
			
			main.addChild(textRight);
			main.addChild(textLeft);
		}
		
		public function drawMarker(e:Event):void
		{
			var len:Number = barLoader.width + 1;
			barSprite.graphics.beginFill(0x666666, 1);
			barSprite.graphics.drawRect(0, 60, 0.75, 20);
			barSprite.graphics.drawRect(len - 2, 60, 0.75, 20);
			barSprite.graphics.drawRect(len / 2, 60, 0.75, 20);
			barSprite.graphics.drawRect(len / 4, 60, 0.75, 15);
			barSprite.graphics.drawRect(len / 4 * 3, 60, 0.75, 15);
			barSprite.graphics.endFill();
		}
		
		public function clickOnBar(e:Event = null):void
		{
			if (main.mouseX > positionX && main.mouseX < (positionX + length))
			{
				if (main.mouseY > positionY - 100 && main.mouseY < positionY + 150)
				{
					maskSprite.x = main.mouseX - maskLoader.width / 2 * maskSprite.scaleX;
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
		}
		
		private function recordChanges():void
		{
			changes += "*" + percentage + "@" + main.getTime();
			trace(changes);
		}
		
		public function update():void
		{
			if (main.contains(maskSprite))
			{
				main.setChildIndex(maskSprite, main.numChildren - 1);
			}
			sprite.y = positionY - 140;
			if (isDragging)
			{
				if (maskSprite.x + 125 < positionX)
				{
					sprite.x = positionX - 125;
				}
				else if (maskSprite.x + 125 > positionX + length)
				{
					sprite.x = positionX + length - 125;
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
			value = sprite.x + 125 - positionX;
			value = value / (length);
			percentage = value * 100;
			
			var loader:Loader;
			var s:String;
			if (value < 0.20)
			{
				loader = myLoader[0];
				s = "20 hours or fewer";
			}
			else if (value < 0.40)
			{
				loader = myLoader[1];
				s = "21-35 hours";
			}
			else if (value < 0.60)
			{
				loader = myLoader[2];
				s = "36-50 hours";
			}
			else if (value < 0.80)
			{
				loader = myLoader[3];
				s = "51-65 hours";
			}
			else
			{
				loader = myLoader[4];
				s = "66+ hours";
			}
			
			if (!sprite.contains(loader))
			{
				while (sprite.numChildren > 0)
				{
					sprite.removeChildAt(0);
				}
				sprite.addChild(loader);
			}
			
			text.changeText(sprite.x - 290, sprite.y - 30, 25, s);
			
			if (main.contains(textRight))
			{
				main.setChildIndex(textRight, main.numChildren - 3);
			}
			if (main.contains(textLeft))
			{
				main.setChildIndex(textLeft, main.numChildren - 3);
			}
			if (main.contains(sprite))
			{
				main.setChildIndex(sprite, main.numChildren - 2);
			}
			if (main.contains(maskSprite))
			{
				main.setChildIndex(maskSprite, main.numChildren - 1);
			}
		}
		
		public function reset():void
		{
			sprite.x = positionX + length / 2 - 125;
		}
	
	}

}