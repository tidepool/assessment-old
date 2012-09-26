package
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	import flash.text.AntiAliasType;
	import flash.text.GridFitType;
	import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
	import flash.text.TextFormat;
	
	public class PictureDrag extends MovieClip
	{
		public var main:Main;
		public var destinationX:Number;
		public var positionX:Number;
		public var positionY:Number;
		public var isDragging:Boolean;
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var textSprite:Sprite = new Sprite();
		public var maskLoader:Loader = new Loader();
		public var maskSprite:Sprite = new Sprite();
		public var index:int;
		public var from:PictureButtonInit;
		public var picString:String;
		public var text:TextField = new TextField();
		
		private var bar:PicDragBar;
		
		public function PictureDrag(p_main:Main, b:PicDragBar, p_x:Number, p_y:Number, s:String, picS:String,ind:int)
		{
			main = p_main;
			picString = picS;
			positionX = p_x;
			positionY = p_y;
			bar = b;
			index = ind;
			
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			maskLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			
			var fileRequest:URLRequest = new URLRequest(picS);
			
			myLoader.load(fileRequest);
			
			fileRequest = new URLRequest(main.prefix + "assets/mask.png");
			maskLoader.load(fileRequest);
			
			isDragging = false;
			sprite.x = positionX;
			destinationX = positionX;
			
			text.text = s;
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
			format1.size = 19;
			text.antiAliasType = AntiAliasType.ADVANCED;
			text.autoSize = TextFieldAutoSize.LEFT;
			text.gridFitType = GridFitType.SUBPIXEL;
			text.setTextFormat(format1);
		}
		
		public function onLoaderReady(e:Event):void
		{
			sprite.addChild(myLoader);
			main.addChild(sprite);
			
			maskSprite.addChild(maskLoader);
			main.addChild(maskSprite);
			
			main.addChild(textSprite);
			destinationX = positionX;
			
			maskSprite.addEventListener(MouseEvent.MOUSE_DOWN, onMouseClick);
			maskSprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			
			var a:Number = myLoader.width;
			if (myLoader.height > a)
			{
				a = myLoader.height;
				sprite.scaleX = 150 / a;
				sprite.scaleY = 150 / a;
			}
			else
			{
				a = myLoader.width;
				sprite.scaleX = 150 / a;
				sprite.scaleY = 150 / a;
			}
			
			maskSprite.scaleX = 1 / maskLoader.width * myLoader.width * sprite.scaleX;
			maskSprite.scaleY = 1 / maskLoader.height * myLoader.height * sprite.scaleY;
			
			sprite.x = positionX;
			
			if (main.contains(maskSprite))
			{
				main.setChildIndex(maskSprite, main.numChildren - 1);
			}
		
		}
		
		public function onMouseClick(e:MouseEvent):void
		{
			main.setChildIndex(maskSprite, main.numChildren - 1);
			main.setChildIndex(sprite, main.numChildren - 2);
			isDragging = true;
			maskSprite.startDrag();
			bar.setOrder();
		}
		
		public function onMouseUp(e:Event):void
		{
			if (isDragging)
			{
				if (bar.compareOrder())
				{
					trace("Same order");
					bar.trackTime(index);
				}
				else
				{
					trace("Different order");
					//bar.changes++;
					bar.trackChange(index);
				}
			}
			isDragging = false;
			maskSprite.stopDrag();
		}
		
		public function update():void
		{
			positionX = sprite.x;
			sprite.y = 400;
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
			
			textSprite.x = sprite.x + 20;
			textSprite.y = sprite.y + 150;
		
		}
	}

}