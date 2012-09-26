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
	/**
	 * ...
	 * @author wei
	 */
	public class label extends MovieClip 
	{
		public var main:Main;
		
		public var positionX:Number;
		public var positionY:Number;
		
		public var sprite:Sprite = new Sprite();
		
		public var text:TextField = new TextField();
		private var format1:TextFormat;
		private var size:Number;
		
		public function label(p_main:Main,p_x:Number,p_y:Number,p_size:int,p_s:String)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			size = p_size;
			
			text.multiline = true;
			text.wordWrap = true;
			text.width = 400;
			text.text = p_s;
			sprite.addChild(text);
			sprite.x = positionX;
			sprite.y = positionY;
			main.addChild(sprite);
			

			
			
			text.selectable = false;
			format1 = new TextFormat();
			format1.font="Arial";
			format1.bold = true;
			format1.size = size;
			format1.align = TextFormatAlign.CENTER;
            text.antiAliasType=AntiAliasType.ADVANCED;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);

			text.textColor = 0;
			
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
			format1.size = p_size;
			format1.bold = true;
			format1.align = TextFormatAlign.CENTER;
            text.antiAliasType=AntiAliasType.ADVANCED;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);
		}
		
		public function changeWidth(p_w:Number):void
		{
			text.width = p_w;
		}
		
		public function formatNumber():void
		{
			format1.size = 55;
			format1.bold = true;
			text.setTextFormat(format1);
		}
		
		public function remove():void
		{
			main.removeChild(sprite);
		}
	}

}