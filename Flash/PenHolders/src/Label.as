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
		
		public var sprite:Sprite;
		private var format1:TextFormat;
		public var text:TextField;
		public var shadow:TextField;
		public var color:uint;
		private var string:String;
		private var textWidth:Number;
		
		public function Label(p_main:Main,p_x:Number,p_y:Number,p_s:String,size:int=35,w:Number=800, c:uint=0x000000)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			color = c;
			string = p_s;
			textWidth = w;
			
			sprite = new Sprite()
			
			format1 = new TextFormat();
			format1.align = TextFormatAlign.CENTER;			
			format1.font="Arial";
			format1.size = size;
			format1.bold = true;
			
			text = new TextField();
			text.multiline = true;
			text.wordWrap = true;
			text.text = string;	
			text.selectable = false;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
			text.width = textWidth;
			text.x = positionX;
			text.y = positionY;
			text.textColor = color;
            text.setTextFormat(format1);
			
			sprite.addChild(text);
			//sprite.x = positionX;
			//sprite.y = positionY;
		}
		
		public function addToPencil(pencil:Pencil):void
		{
			pencil.sprite.addChild(sprite);
			pencil.sprite.setChildIndex(sprite, pencil.sprite.numChildren - 1);
		}
		
		public function addToMain():void
		{
			main.addChild(sprite);
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
		public function changeText(p_x:Number,p_y:Number,p_size:int,s:String,width:Number=600):void
		{
			positionX = p_x;
			positionY = p_y;			
			string = s;
			text.text = s;
			sprite.x = positionX;
			sprite.y = positionY;
			
			var format1:TextFormat = new TextFormat();
			format1.align = TextFormatAlign.CENTER;	
			format1.font="Arial";
			format1.size=p_size;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);
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