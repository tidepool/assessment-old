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
		public var format1:TextFormat;
		
		public var sprite:Sprite = new Sprite();
		
		public var text:TextField = new TextField();
		
		public function Label(p_main:Main,p_x:Number,p_y:Number,p_s:String,size:int=25, p_w:Number = 800)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			text.multiline = true;
			text.wordWrap = true;
			text.width = p_w;
			text.text = p_s;
			sprite.addChild(text);
			sprite.x = positionX;
			sprite.y = positionY;
			main.addChild(sprite);
			

			
			
			text.selectable = false;
			format1 = new TextFormat();
			format1.font="Arial";
			format1.size=size;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
			format1.align = TextFormatAlign.CENTER;
            text.setTextFormat(format1);

			text.textColor = 0x000000;
			
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
			text.textColor = 0x000000;
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