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
	import flash.text.AntiAliasType;
	import flash.text.GridFitType;
	import flash.text.*;
	
	public class Label extends MovieClip 
	{
		public var main:Main;
		
		public var positionX:Number;
		public var positionY:Number;		
		public var text:TextField = new TextField();
		public var sprite:Sprite = new Sprite();
		public var shadow:TextField;
		
		private var format1:TextFormat;
		private var color:uint;
		private var string:String;
		private var textWidth:Number;
		
		
		public function Label(p_main:Main,p_x:Number,p_y:Number,size:int=30, p_w:Number = 400, p_s:String = "", alignment:int = 1, c:uint = 0x000000)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			color = c; 
			string = p_s;
			textWidth = p_w;
			
			text = new TextField();
			text.multiline = true;
			text.wordWrap = true;			
			text.width = textWidth;
			text.text = string;
			if (p_s == "Interests")
			{
				text.x = positionX-150;
			}
			else
			{
				text.x = positionX;
			}
			text.y = positionY;	
			text.textColor = color;
			
			text.selectable = false;
			text.mouseEnabled = false;
			format1 = new TextFormat();
			format1.font = "Arial";
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
			format1.size = size;
			format1.bold = true;
            text.setTextFormat(format1);
			sprite.addChild(text);
			main.addChild(sprite);
		}
		
		public function update():void
		{
			//text.x = positionX;
		}
		public function changeText(p_x:Number,p_y:Number,p_size:int, p_w:Number,s:String, alignment:int = 1):void
		{
			positionX = p_x;
			positionY = p_y;
			text.text = s;
			text.y = positionY;			
			text.width = p_w;
			text.textColor = color;
			
			format1.font="Arial";
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
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);
		}
		
		public function addShadow():void
		{
			shadow = new TextField();
			shadow.multiline = true;
			shadow.wordWrap = true;
			shadow.text = string;	
			shadow.selectable = false;
            shadow.antiAliasType=AntiAliasType.ADVANCED;
            shadow.autoSize=TextFieldAutoSize.LEFT;
			shadow.gridFitType=GridFitType.SUBPIXEL;
			shadow.width = textWidth;
			shadow.textColor = 0x000000;
			shadow.x = positionX+ 2;
			shadow.y = positionY + 2;
            shadow.setTextFormat(format1);
			
			sprite.addChild(shadow);
			sprite.setChildIndex(shadow, 0);
			sprite.setChildIndex(text, 1);
		}
		
		public function changeWidth(p_w:Number):void
		{
			text.width = p_w;
		}
	}

}