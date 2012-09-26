package
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.SpreadMethod;
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
		public var shadow:TextField;
		public var text:TextField = new TextField();
		
		private var format1:TextFormat;
		private var color:uint;
		private var string:String;
		
		public function Label(p_main:Main, p_x:Number, p_y:Number, p_s:String = "", p_size:int = 30, p_w:Number = 400, alignment:int = 1, c:uint = 0x000000)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			color = c;
			string = p_s;
			
			text = new TextField();
			text.multiline = true;
			text.wordWrap = true;
			text.width = p_w;
			text.text = string;
			text.x = positionX;
			text.y = positionY;
			text.textColor = color;
			
			text.selectable = false;
			text.mouseEnabled = false;
			format1 = new TextFormat();
			format1.font = "Helvetica";
			if (alignment == 0)
			{
				format1.align = TextFormatAlign.LEFT;
			}
			else if (alignment == 1)
			{
				format1.align = TextFormatAlign.CENTER;
			}
			else if (alignment == 2)
			{
				format1.align = TextFormatAlign.RIGHT;
			}
			text.antiAliasType = AntiAliasType.ADVANCED;
			text.autoSize = TextFieldAutoSize.LEFT;
			text.gridFitType = GridFitType.SUBPIXEL;
			format1.size = p_size;
			text.setTextFormat(format1);
			sprite.addChild(text);
			main.addChild(sprite);
		}
		
		public function update():void
		{
			text.x = positionX;
		}
		
		public function changeText(p_x:Number, p_y:Number, p_s:String = "", p_size:int = 30, p_w:Number = 400, alignment:int = 1, c:uint = 0x000000):void
		{
			positionX = p_x;
			positionY = p_y;
			text.text = p_s;
			text.x = positionX;
			text.y = positionY;
			text.width = p_w;
			text.textColor = color;
			
			format1.font = "helvetica";
			format1.size = p_size;
			if (alignment == 0)
			{
				format1.align = TextFormatAlign.LEFT;
			}
			else if (alignment == 1)
			{
				format1.align = TextFormatAlign.CENTER;
			}
			else if (alignment == 2)
			{
				format1.align = TextFormatAlign.RIGHT;
			}
			text.antiAliasType = AntiAliasType.ADVANCED;
			text.autoSize = TextFieldAutoSize.LEFT;
			text.gridFitType = GridFitType.SUBPIXEL;
			text.setTextFormat(format1);
		}

		public function addBold():void
		{
			format1.bold = true;
			text.setTextFormat(format1);
		}
	}

}