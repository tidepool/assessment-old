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
	
	public class pictureShuttle extends MovieClip 
	{
		public var main:Main;
		public var bar:PicDragBar;
		public var positionX:Number;
		public var positionY:Number;
		public var vX:Number;
		public var vY:Number;
		public var destinationX:Number;
		public var destinationY:Number;
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var isActive:Boolean;
		public var string:String = new String();
		public var textSprite:Sprite = new Sprite();
		public var text:TextField = new TextField();
		public var from:pictureButtonInit;
		public var isBack:Boolean;
		public var picString:String;
		
		public function pictureShuttle(p_main:Main,P_bar:PicDragBar,p_x:Number,p_y:Number) 
		{
			main = p_main;
			bar = P_bar;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			sprite.addChild(myLoader);
			isActive = false;
			
			
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
			if (isBack)
			{
				from.active = true;
				from.sprite.alpha = 1;
				from.text.textColor = 0x8746FF;
			}
			else
			{
				bar.addPictureDrag(destinationX, destinationY, string,picString);
			}
			main.removeChild(sprite);
			isActive = false;
			
			bar.sort();
			text.text = "";
		}
		
		public function setActive(p_x:Number,p_y:Number ,p_desX:Number,p_desY:Number, s:String,sPic:String) :void
		{
			picString = sPic;
			var fileRequest:URLRequest = new URLRequest(main.prefix + picString);
			
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
			myLoader.scaleX = 0.5;
			myLoader.scaleY = 0.5;
			vX = ( destinationX - p_x ) / 8;
			vY = (destinationY - p_y) / 8;
			
			
			
		}
		
		public function update():void
		{
			if (isActive)
			{
				main.setChildIndex(textSprite, main.numChildren - 1);
				main.setChildIndex(sprite,main.numChildren-2);
			}
			sprite.x = vX + sprite.x;
			sprite.y = vY + sprite.y;
			if ((destinationX - sprite.x) * (destinationX - sprite.x) < 0.2 && (destinationY - sprite.y) * (destinationY - sprite.y) < 0.2)
			{
				if (isActive)
				{
					setDeactivated();
				}
			}
			textSprite.x = sprite.x + 20;
			textSprite.y = sprite.y + 150;
		}
		
		
		
	}

}