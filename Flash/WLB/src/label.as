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

	public class label extends MovieClip 
	{
		public var main:Main;
		
		public var positionX:Number;
		public var positionY:Number;
		
		public var sprite:Sprite = new Sprite();
		private var format1:TextFormat;
		public var text:TextField = new TextField();
		public var color:uint;
		public var isCentered:Boolean = true;
		
		public function label(p_main:Main,p_x:Number,p_y:Number,p_s:String,size:int=35,width:Number=800, c:uint=0x000000,p_isCentered:Boolean=true)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			color = c;
			isCentered = p_isCentered;
			
			format1 = new TextFormat();
			if (isCentered)
			{
			format1.align = TextFormatAlign.CENTER;	
			}
			else
			{
			format1.align = TextFormatAlign.LEFT;	
			}
			format1.font="Arial";
			format1.size = size;
			//format1.bold = true;
			
			text.multiline = true;
			text.wordWrap = true;
			text.text = p_s;	
			text.selectable = false;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
			text.width = width;
			text.textColor = color;
            text.setTextFormat(format1);
			
			sprite.addChild(text);
			sprite.x = positionX;
			sprite.y = positionY;
			main.addChild(sprite);
		}
		
		
		public function changeText(p_x:Number,p_y:Number,p_size:int,s:String,width:Number=600):void
		{
			positionX = p_x;
			positionY = p_y;
			text.text = s;
			sprite.x = positionX;
			sprite.y = positionY;
			
			var format1:TextFormat = new TextFormat();
			if (isCentered)
			{
			format1.align = TextFormatAlign.CENTER;	
			}
			else
			{
			format1.align = TextFormatAlign.LEFT;	
			}
			
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