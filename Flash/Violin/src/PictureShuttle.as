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

	public class PictureShuttle extends MovieClip 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var destinationX:Number;
		public var destinationY:Number;
		public var destinationS:Number;
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var isActive:Boolean;
		public var string:String = new String();
		public var textSprite:Sprite = new Sprite();
		public var text:TextField = new TextField();
		public var speed:int;
		public var removeMe:Boolean;
		
		public function PictureShuttle(p_main:Main,p_x:Number,p_y:Number) 
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			sprite.addChild(myLoader);
			isActive = false;
			
			speed = 20;
			removeMe = false;
		}
		
		public function onLoaderReady(e:Event) :void
		{     
			sprite.x = positionX;
			sprite.y = positionY;
			
			main.addChild(sprite);
			main.addChild(textSprite);
			isActive = true;
		} 
		
		public function setDeactivated() :void
		{
			isActive = false;
			removeMe = true;
			main.addBar();
			text.text = "";
		}
		
		public function setActive(p_x:Number,p_y:Number ,p_desX:Number,p_desY:Number,pic_s:String, s:String,p_scale:Number) :void
		{
			var fileRequest:URLRequest = new URLRequest(main.prefix + pic_s);
			
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
			
			
			myLoader.load(fileRequest);
			positionX = p_x;
			positionY = p_y;
			destinationX = p_desX;
			destinationY = p_desY;
			string = s;
			myLoader.scaleX = p_scale;
			myLoader.scaleY = p_scale;
			destinationS=p_scale;
			sprite.x = destinationX;
			sprite.y = destinationY;
			sprite.x = positionX;
			sprite.y = positionY;
		}
		
		public function update():void
		{
			if (isActive)
			{
				main.setChildIndex(textSprite, main.numChildren - 1);
				main.setChildIndex(sprite,main.numChildren-2);
			}
			sprite.x += (-sprite.x + destinationX) / 3;
			sprite.y += (-sprite.y + destinationY) / 3;
			if ((destinationX - sprite.x) * (destinationX - sprite.x) < 0.2 && (destinationY - sprite.y) * (destinationY - sprite.y) < 0.2)
			{
				if (isActive)
				{
					setDeactivated();
				}
			}
			textSprite.x = sprite.x + 20;
			textSprite.y = sprite.y + 20;
		}
		
	}

}