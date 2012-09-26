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
	
	public class Label extends MovieClip 
	{
		public var main:Main;
		
		public var positionX:Number;
		public var positionY:Number;
		
		public var sprite:Sprite = new Sprite();
		
		public var text:TextField = new TextField();
		private var isScroller:Boolean;
		public var screen:FeedBackScreen;
		
		public function Label(p_main:Main, p_x:Number, p_y:Number, p_s:String, size:int = 25, isSc:Boolean = false,p_screen:FeedBackScreen=null)
		{
			main = p_main;
			screen = p_screen;
			positionX = p_x;
			positionY = p_y;
			text.multiline = true;
			text.wordWrap = true;
			text.width = 800;
			text.text = p_s;
			sprite.addChild(text);
			sprite.x = positionX;
			sprite.y = positionY;
			main.addChild(sprite);
			isScroller = isSc;
			
			
			text.selectable = false;
			var format1:TextFormat = new TextFormat();
			format1.font="Arial";
			format1.size=size;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
			format1.align = TextFormatAlign.CENTER;
            text.setTextFormat(format1);

			text.textColor = 0xFFFFFF;
			
			if (isScroller)
			{
				
			}
			if (screen != null)
			{
				sprite.addEventListener(MouseEvent.MOUSE_OVER, over);
				sprite.addEventListener(MouseEvent.MOUSE_MOVE, over);
			}
			
		}
		
		public function over(e:Event = null):void
		{
			screen.pic.sprite.x = positionX+300-screen.pic.myLoader.width/2  * screen.pic.sprite.scaleX;
		}
		
		public function changeText(p_x:Number,p_y:Number,p_size:int,s:String):void
		{
			positionX = p_x;
			positionY = p_y;
			text.text = s;
			sprite.x = positionX;
			sprite.y = positionY;
			
			var format1:TextFormat = new TextFormat();
			format1.font="Arial";
			format1.size=p_size;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
			format1.align = TextFormatAlign.CENTER;
            text.setTextFormat(format1);
			text.textColor = 0xFFFFFF;
		}
		public function changeColor(color:uint):void
		{
			text.textColor = color;
		}
		
		public function changeWidth(p_w:Number):void
		{
			text.width = p_w;
		}
		
		public function remove():void
		{
			main.removeChild(sprite);
		}
	}

}