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
	
	public class pictureDrag extends MovieClip 
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
		public var from:pictureButtonInit;
		
		public var picString:String;
		
		public var text:TextField = new TextField();
		
		public function pictureDrag(p_main:Main,p_x:Number,p_y:Number,s:String,picS:String) 
		{
			main = p_main;
			picString = picS;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			
			var fileRequest:URLRequest = new URLRequest(main.prefix + picS);
			
			myLoader.load(fileRequest);
			
			fileRequest = new URLRequest(main.prefix + "assets/projective/mask.png");
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
			format1.font="Arial";
			format1.size=19;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);
		}
		
		public function onLoaderReady(e:Event) :void
		{        
			sprite.addChild(myLoader);
			main.addChild(sprite);
			
			maskSprite.addChild(maskLoader);
			main.addChild(maskSprite);
			
			main.addChild(textSprite);
			destinationX = positionX;
			
			maskSprite.addEventListener(MouseEvent.MOUSE_DOWN, onMouseClick);
			maskSprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			
			sprite.scaleX = 0.5;
			sprite.scaleY = 0.5;
			
			maskSprite.scaleX = 1 / maskLoader.width * myLoader.width * sprite.scaleX;
			maskSprite.scaleY = 1 / maskLoader.height * myLoader.height * sprite.scaleY;
			
			sprite.x = positionX;

			
			
		} 
		
		
		public function onMouseClick(e:MouseEvent) :void
		{
			if (e.altKey != true)
			{
				main.setChildIndex(maskSprite,main.numChildren-1);
				main.setChildIndex(sprite,main.numChildren-2);
				isDragging = true;
				maskSprite.startDrag();
			}
			else
			{
				/*
				main.count--;
				main.pictureDrags.splice(main.pictureDrags.indexOf(this, 0), 1);
				main.sendShuttle(sprite.x,sprite.y,text.text,true,from);
				main.removeChild(sprite);
				main.removeChild(textSprite);
				main.removeChild(maskSprite);
				*/
			}
		}
		
		public function onMouseUp(e:Event) :void
		{
			isDragging = false;
			maskSprite.stopDrag();
		}
		
		
		public function update():void
		{
			positionX = sprite.x;
			sprite.y = 200;
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