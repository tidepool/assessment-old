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
		public var updateY:Boolean = true;
		
		public function Label(p_main:Main,p_x:Number,p_y:Number,p_s:String,size:int=25,t_width:Number=800,isCentered:Boolean=false)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			text.multiline = true;
			text.wordWrap = true;
			text.width = t_width;
			text.text = p_s;
			sprite.addChild(text);
			sprite.x = positionX - text.width / 2;
			sprite.y = positionY - text.textHeight / 2;
			main.addChild(sprite);			
			
			text.selectable = false;
			var format1:TextFormat = new TextFormat();
			format1.font="Arial";
			format1.size=size;
            text.antiAliasType=AntiAliasType.ADVANCED;
			if (isCentered)
			{
				format1.align = TextFormatAlign.CENTER;
			}
			else
			{
				format1.align = TextFormatAlign.LEFT;				
			}
            text.autoSize = TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);
		//	text.textColor = 0xFFFFFF;
		}
		
		
		public function changeText(p_x:Number,p_y:Number,p_size:int,s:String,twidth:Number=600,isCentered:Boolean=false):void
		{
			positionX = p_x;
			positionY = p_y;
			text.text = s;
			
			text.width = twidth;
			var format1:TextFormat = new TextFormat();
			format1.font="Arial";
			format1.size = p_size;
			if (isCentered)
			{
				format1.align = TextFormatAlign.CENTER;
			}
			else
			{
				format1.align = TextFormatAlign.LEFT;				
			}
            text.antiAliasType=AntiAliasType.ADVANCED;
            //text.autoSize=TextFieldAutoSize.RIGHT;
			text.gridFitType = GridFitType.SUBPIXEL;
            text.setTextFormat(format1);
			sprite.x = positionX - twidth / 2;
			if(updateY)
			sprite.y = positionY - text.textHeight / 2;
		//	text.textColor = 0xFFFFFF;
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