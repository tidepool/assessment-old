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
	
	public class DragPicture extends MovieClip
	{
		public var main:Main;
		public var destinationX:Number;
		public var positionX:Number;
		public var positionY:Number;
		public var isDragging:Boolean;
		public var type:String;
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var textSprite:Sprite = new Sprite();
		public var maskLoader:Loader = new Loader();
		public var maskSprite:Sprite = new Sprite();		
		public var text:TextField = new TextField();;
		public var index:int;
		
		private var bar:DragBar;
		
		public function DragPicture(p_main:Main, b:DragBar, p_x:Number, p_y:Number, picture_s:String,ind:int)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			maskLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			type = picture_s;
			bar = b;
			index = ind;
			
			myLoader.load(new URLRequest(main.prefix + "assets/" + ind + ".jpg"));
			maskLoader.load(new URLRequest(main.prefix + "assets/mask.png"));
			isDragging = false;
			sprite.x = positionX;
			destinationX = positionX;
			
			text.text = type;
			text.multiline = true;
			text.wordWrap = true;
			text.width = 120;
			text.textColor = 0x8746FF;
			textSprite.addChild(text);
			textSprite.x = positionX;
			textSprite.y = positionY;
			
			text.selectable = false;
			var format1:TextFormat = new TextFormat();
			format1.font = "Arial";
			format1.size = 18;
			text.antiAliasType = AntiAliasType.ADVANCED;
			text.autoSize = TextFieldAutoSize.LEFT;
			text.gridFitType = GridFitType.SUBPIXEL;
			text.setTextFormat(format1);
		}
		
		public function onLoaderReady(e:Event):void
		{
			sprite.addChild(myLoader);
			maskSprite.addChild(maskLoader);
			main.addChild(sprite);
			main.addChild(textSprite);
			main.addChild(maskSprite);
			destinationX = positionX;
			
			maskSprite.addEventListener(MouseEvent.MOUSE_DOWN, onMouseDown);
			maskSprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			main.stage.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			
			var a:Number = myLoader.width;
			if (myLoader.height > a)
			{
				a = myLoader.height;
			}
			sprite.scaleX = 1 / a * 150;
			sprite.scaleY = 1 / a * 150;
			
			maskSprite.scaleX = 1 / maskLoader.width * myLoader.width * sprite.scaleX;
			maskSprite.scaleY = 1 / maskLoader.height * myLoader.height * sprite.scaleY;
			
			sprite.x = positionX;
			
			main.setChildIndex(textSprite, main.numChildren - 1);
			main.setChildIndex(sprite, main.numChildren - 1);
			main.setChildIndex(maskSprite, main.numChildren - 1);
		
		}
		
		public function onMouseDown(e:Event):void
		{
			main.setChildIndex(textSprite, main.numChildren - 1);
			main.setChildIndex(sprite, main.numChildren - 1);
			main.setChildIndex(maskSprite, main.numChildren - 1);
			isDragging = true;
			maskSprite.startDrag();
			bar.trackClick(index);
			bar.setOrder();
		}
		
		public function onMouseUp(e:Event = null):void
		{
			if (isDragging)
			{
				if (bar.compareOrder())
				{
					//trace("Same order");
				}
				else
				{
					//trace("Different order");
					//bar.changes++;
					bar.trackChange();
				}
			}
			isDragging = false;
			maskSprite.stopDrag();
		}
		
		public function update():void
		{
			positionX = sprite.x;
			sprite.y = 400 - myLoader.height * sprite.scaleX / 2;
			//	sprite.y = 300;
			//	300 - myLoader.height / a * 150 / 2
			
			sprite.x = sprite.x + (destinationX - sprite.x) / 5;
			
			if (isDragging)
			{
				sprite.x = maskSprite.x;
			}
			else
			{
				maskSprite.x = sprite.x;
				maskSprite.y = sprite.y;
			}
			
			textSprite.x = sprite.x;
			textSprite.y = 500;
		
		}
	}

}