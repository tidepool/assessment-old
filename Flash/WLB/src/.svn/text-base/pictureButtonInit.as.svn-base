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
	
	public class pictureButtonInit extends MovieClip 
	{
		public var main:Main;
		public var bar:PicDragBar;
		public var positionX:Number;
		public var positionY:Number;
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var textSprite:Sprite = new Sprite();
		public var maskLoader:Loader = new Loader();
		public var maskSprite:Sprite = new Sprite();
		public var active:Boolean;
		public var text:TextField = new TextField();
		public var picString:String;
		public var maskString:String;
		
		public function pictureButtonInit(p_main:Main,p_bar:PicDragBar,p_x:Number,p_y:Number,stext:String,spicture:String,smask:String=null) 
		{
			main = p_main;
			bar = p_bar;
			active = true;
			positionX = p_x;
			positionY = p_y;
			picString = spicture;
			maskString = smask;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			
			var fileRequest:URLRequest = new URLRequest(main.prefix + spicture);
			
			myLoader.load(fileRequest);
			if (smask != null)
			{
				fileRequest = new URLRequest(main.prefix + "assets/BouncingBalls/circleMask.png");
				maskLoader.load(fileRequest);
			}
			sprite.x = positionX;
			
			text.text = stext;
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
			main.addChild(textSprite);
			if (maskString != null)
			{
				maskSprite.addChild(maskLoader);
				main.addChild(maskSprite);
			}
			
			if (maskString != null)
			{
				maskSprite.addEventListener(MouseEvent.CLICK, onMouseClick);
				maskSprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			}
			else
			{
				sprite.addEventListener(MouseEvent.CLICK, onMouseClick);
				sprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			}
			
			sprite.scaleX = 0.5;
			sprite.scaleY = 0.5;
			maskSprite.scaleX = 0.5;
			maskSprite.scaleY = 0.5;
			
			sprite.x = positionX;
			sprite.y = positionY;
			maskSprite.x = positionX;
			maskSprite.y = positionY;

			textSprite.x = sprite.x + 20;
			textSprite.y = sprite.y + 150;
			
		} 
		
		public function onMouseClick(e:MouseEvent) :void
		{

			
			if (active)
			{
				active = false;
			//	main.removeChild(sprite);
			//	var fileRequest:URLRequest = new URLRequest("circle1.png");
			//	myLoader.load(fileRequest);
				text.textColor = 0xAAAAAA;
				sprite.alpha = 0.5;
				bar.sendShuttle(sprite.x, sprite.y, text.text,picString);
				
			}
		}
		
		public function onMouseUp(e:Event) :void
		{
		}
		
		
		public function update():void
		{			
		}
	}

}