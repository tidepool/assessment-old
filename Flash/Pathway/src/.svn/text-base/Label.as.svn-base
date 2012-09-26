package
{
	import flash.display.Sprite;
	import flash.text.*;
	
	public class Label
	{
		public var main:Main;
		
		private var positionX:Number;
		private var positionY:Number;
		
		private var sprite:Sprite = new Sprite();
		
		private var text:TextField = new TextField();
		
		//public var messageBox:MessageBox;
		
		public function Label(p_main:Main, p_x:Number, p_y:Number, p_s:String, size:int = 25, w:Number = 800)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			text.multiline = true;
			text.wordWrap = true;
			text.width = w;
			text.text = p_s;
			sprite.addChild(text);
			sprite.x = positionX;
			sprite.y = positionY;
			main.addChild(sprite);
			
			text.selectable = false;
			var format1:TextFormat = new TextFormat();
			format1.font = "Arial";
			format1.size = size;
			format1.bold = true;
			text.antiAliasType = AntiAliasType.ADVANCED;
			text.autoSize = TextFieldAutoSize.LEFT;
			text.gridFitType = GridFitType.SUBPIXEL;
			text.setTextFormat(format1);
			
			text.width = w;
			text.textColor = 0x7452FF;
			sprite.x = positionX - text.textWidth / 2;
			sprite.y = positionY - text.textHeight / 2;
		}
		
		public function changeText(p_x:Number, p_y:Number, p_size:int, s:String, width:Number = 600):void
		{
			positionX = p_x;
			positionY = p_y;
			text.text = s;
			sprite.x = positionX;
			sprite.y = positionY;
			
			var format1:TextFormat = new TextFormat();
			format1.font = "Arial";
			format1.size = p_size;
			text.antiAliasType = AntiAliasType.ADVANCED;
			text.autoSize = TextFieldAutoSize.LEFT;
			text.gridFitType = GridFitType.SUBPIXEL;
			text.setTextFormat(format1);
			text.textColor = 0x7452FF;
			sprite.x = positionX - text.textWidth / 2;
			sprite.y = positionY - text.textHeight / 2;
		}
		
		public function changeWidth(p_w:Number):void
		{
			text.width = p_w;
		}
		public function changeColor(col:uint):void
		{
			text.textColor = col;
		}
		
		public function changeAlpha(alph:Number):void
		{
			text.alpha = alph;
		}
		
		public function show():void
		{
			if (!main.contains(sprite))
			{
				main.addChild(sprite);
			}
		}
		
		public function hide():void
		{
			if (main.contains(sprite))
			{
				main.removeChild(sprite);
			}
		}
		
		public function remove():void
		{
			main.removeChild(sprite);
		}
	}

}