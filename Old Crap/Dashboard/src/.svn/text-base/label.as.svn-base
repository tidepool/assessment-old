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
		
		public function label(p_main:Main,p_x:Number,p_y:Number,p_s:String,size:int=25,width:Number=800,isleft:Boolean=true)
		{
			main = p_main;
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
			

			
			
			text.selectable = false;
			var format1:TextFormat = new TextFormat();
			format1.font = "Arial";
			format1.align = "left";
			format1.size = size;
			format1.bold = true;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);

			text.width = width;
		//	text.textColor = 0xFFFFFF;
			sprite.x = positionX - text.textWidth / 2;
			sprite.y = positionY - text.textHeight / 2;
			if(isleft)
			sprite.x = positionX ;
		//	sprite.y = positionY ;
		}
		
		
		public function changeText(p_x:Number,p_y:Number,p_size:int,s:String,width:Number=600):void
		{
			positionX = p_x;
			positionY = p_y;
			text.text = s;
			sprite.x = positionX;
			sprite.y = positionY;
			
			var format1:TextFormat = new TextFormat();
			format1.font="Arial";
			format1.align = "left";
			format1.size=p_size;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);
		//	text.textColor = 0xFFFFFF;
			sprite.x = positionX - text.textWidth / 2;
			sprite.y = positionY - text.textHeight / 2;
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