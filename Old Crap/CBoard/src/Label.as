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
	import flash.filters.DropShadowFilter;
	
	/**
	 * ...
	 * @author wei
	 */
	public class Label extends MovieClip 
	{
		public var main:Object;
		
		public var positionX:Number;
		public var positionY:Number;
		public var sprite:Sprite = new Sprite();
		public var text:TextField = new TextField();
		public var isCentered:Boolean = true;
		private var color:uint;
		private var format1:TextFormat;
		private var shadow:TextField = new TextField();
		
		public function Label(p_main:Object,p_x:Number,p_y:Number,p_s:String,size:int=25,width:Number=800,p_isCentered:Boolean=true,c:uint=0x000000)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			text.multiline = true;
			text.wordWrap = true;
			color = c;
			text.width = 800;
			text.text = p_s;
			sprite.addChild(text);
			sprite.x = positionX;
			sprite.y = positionY;
			text.textColor = color;
			main.addChild(sprite);
			isCentered = p_isCentered;

			
			
			text.selectable = false;
			format1 = new TextFormat();
			format1.font="helvetica";
			format1.size = size;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);

			text.width = width;
		//	text.textColor = 0xFFFFFF;
		
			if (isCentered)
			{
				sprite.x = positionX - text.textWidth / 2;
			}
			else
			{
				sprite.x = positionX;
			}
		//	sprite.x = positionX - text.textWidth / 2;
			sprite.y = positionY - text.textHeight / 2;
		}
		
		
		public function changeText(p_x:Number,p_y:Number,p_size:int,s:String,width:Number=600):void
		{
			positionX = p_x;
			positionY = p_y;
			text.text = s;
			sprite.x = positionX;
			sprite.y = positionY;
			
			format1 = new TextFormat();
			format1.font="helvetica";
			format1.size=p_size;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);
		//	text.textColor = 0xFFFFFF;	
			if (isCentered)
			{
				sprite.x = positionX - text.textWidth / 2;
			}
			else
			{
				sprite.x = positionX;
			}
			sprite.y = positionY - text.textHeight / 2;
			
		}
		
		public function changeString(string:String):void
		{
			text.text = string;
            text.setTextFormat(format1);
		}
		
		public function addDropShadow():void 
		{ 
			shadow = new TextField();
			shadow.text = text.text;
			shadow.width = text.width;
			shadow.selectable = false;
            shadow.antiAliasType=AntiAliasType.ADVANCED;
            shadow.autoSize=TextFieldAutoSize.LEFT;
			shadow.gridFitType=GridFitType.SUBPIXEL;
			shadow.textColor = 0;
			shadow.x += 1.25;
			shadow.y += 1.25;			
			sprite.addChild(shadow);
			sprite.setChildIndex(shadow, 0);
            shadow.setTextFormat(format1);
		} 
		
		public function addBold():void 
		{ 
			format1.bold = true;
            text.setTextFormat(format1);
		} 
		
		public function setPosition(px:Number,py:Number):void
		{
			positionX = px;
			positionY = py;
			if (isCentered)
			{
			sprite.x = positionX - text.textWidth / 2;
			}
			else
			{
				sprite.x = positionX;
			}
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