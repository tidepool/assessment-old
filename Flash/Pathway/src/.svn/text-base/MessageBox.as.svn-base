package  
{
	import flash.display.Sprite;
	import flash.text.*;
	
	public class MessageBox 
	{
		private var main:Main;
		private var positionX:Number;
		private var positionY:Number;
		private var boxWidth:Number;
		private var boxHeight:Number;
		private var sprite:Sprite = new Sprite();		
		private var background:Sprite = new Sprite();
		private var string:String = new String();		
		private var msg:TextField = new TextField();
		private	var format1:TextFormat;
		
		public function MessageBox(m:Main,x:Number=0,y:Number=0,w:Number=100,s:String="",size:int=24) 
		{
			main = m;
			positionX = x;
			positionY = y;
			boxWidth = w;
			string = s;
			
			msg.multiline = true;
			msg.wordWrap = true;
			msg.width = w;
			msg.text = s;
			msg.textColor = 0x7452FF;
			msg.selectable = false;
            msg.antiAliasType=AntiAliasType.ADVANCED;
            msg.autoSize=TextFieldAutoSize.LEFT;
			msg.gridFitType = GridFitType.SUBPIXEL;
			
			format1 = new TextFormat();
			format1.font="Arial";
			format1.size = size;
			format1.bold = true;
			format1.align = TextFormatAlign.CENTER;
            msg.setTextFormat(format1);
			
			boxHeight = msg.textHeight + 5;
			msg.x = positionX;
			msg.y = positionY;
			background.graphics.beginFill(0xFFFFFF,0.05);
			background.graphics.drawRect(positionX - 10, positionY - 10, boxWidth + 20, boxHeight + 20);			
			background.graphics.endFill();
			background.graphics.beginFill(0xFFFFFF,0.1);
			background.graphics.drawRect(positionX - 9, positionY - 1, boxWidth + 18, boxHeight + 18);
			background.graphics.endFill();			
			background.graphics.beginFill(0xFFFFFF,0.15);
			background.graphics.drawRect(positionX - 8, positionY - 8, boxWidth + 16, boxHeight + 16);
			background.graphics.endFill();					
			background.graphics.beginFill(0xFFFFFF,0.2);
			background.graphics.drawRect(positionX - 7, positionY - 7, boxWidth + 14, boxHeight + 14);
			background.graphics.endFill();		
			background.graphics.beginFill(0xFFFFFF,0.25);
			background.graphics.drawRect(positionX- 6, positionY-6, boxWidth + 12, boxHeight + 12);
			background.graphics.endFill();
			background.graphics.beginFill(0xFFFFFF,0.3);
			background.graphics.drawRect(positionX- 5, positionY-5, boxWidth + 10, boxHeight + 10);
			background.graphics.endFill();			
			background.graphics.beginFill(0xFFFFFF,0.35);
			background.graphics.drawRect(positionX - 4, positionY - 4, boxWidth + 8, boxHeight + 8);	
			background.graphics.endFill();
			
			sprite.addChild(background);
			sprite.addChild(msg);
			main.addChild(sprite);
			main.setChildIndex(sprite,main.numChildren - 1);
		}
		
		public function changeMessage(s:String):void
		{
			msg.text = s;
            msg.setTextFormat(format1);
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
		
		public function update():void
		{
			background.graphics.clear();
			boxHeight = msg.textHeight + 5;
			background.graphics.beginFill(0xFFFFFF,0.05);
			background.graphics.drawRect(positionX - 10, positionY - 10, boxWidth + 20, boxHeight + 20);			
			background.graphics.endFill();
			background.graphics.beginFill(0xFFFFFF,0.1);
			background.graphics.drawRect(positionX - 9, positionY - 1, boxWidth + 18, boxHeight + 18);
			background.graphics.endFill();			
			background.graphics.beginFill(0xFFFFFF,0.15);
			background.graphics.drawRect(positionX - 8, positionY - 8, boxWidth + 16, boxHeight + 16);
			background.graphics.endFill();					
			background.graphics.beginFill(0xFFFFFF,0.2);
			background.graphics.drawRect(positionX - 7, positionY - 7, boxWidth + 14, boxHeight + 14);
			background.graphics.endFill();		
			background.graphics.beginFill(0xFFFFFF,0.25);
			background.graphics.drawRect(positionX- 6, positionY-6, boxWidth + 12, boxHeight + 12);
			background.graphics.endFill();
			background.graphics.beginFill(0xFFFFFF,0.3);
			background.graphics.drawRect(positionX- 5, positionY-5, boxWidth + 10, boxHeight + 10);
			background.graphics.endFill();			
			background.graphics.beginFill(0xFFFFFF,0.35);
			background.graphics.drawRect(positionX - 4, positionY - 4, boxWidth + 8, boxHeight + 8);	
			background.graphics.endFill();
		}
	}

}