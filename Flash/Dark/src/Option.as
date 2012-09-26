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
	
	public class Option extends MovieClip 
	{
		public var main:Main;
		
		public var positionX:Number;
		public var positionY:Number;
		
		public var sprite:Sprite = new Sprite();
		
		public var text:TextField=new TextField();
		
		public function Option(p_main:Main,p_x:Number,p_y:Number,p_s:String,size:int=50)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			
			text.text = p_s;
			sprite.addChild(text);
			sprite.x = positionX;
			sprite.y = positionY;
			text.width = 200;
			
			text.addEventListener(MouseEvent.MOUSE_MOVE, mouseOn);
			text.addEventListener(MouseEvent.MOUSE_OUT, mouseOut);
			
			text.selectable = false;
			var format1:TextFormat = new TextFormat();
			format1.font="Arial";
			format1.size=size;
			format1.align = TextFormatAlign.CENTER;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);
			text.textColor = 0xFFFFFF;
			show();
		}
		
		public function mouseOn(e:Event):void
		{
			text.textColor = 464;
		}
		
		public function mouseOut(e:Event):void
		{
			text.textColor = 0xFFFFFF;
		}
		
		
		public function show():void
		{
			main.addChild(sprite);
		}
		
		public function hide():void
		{
			main.removeChild(sprite);
		}
		
		public function changeText(s:String):void
		{
			text.text = s;
			text.selectable = false;
			var format1:TextFormat = new TextFormat();
			format1.font="Arial";
			format1.size=50;
			format1.align = TextFormatAlign.CENTER;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);
			text.textColor = 0xFFFFFF;
		}
	}

}