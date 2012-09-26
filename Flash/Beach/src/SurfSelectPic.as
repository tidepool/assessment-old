package
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	
	public class SurfSelectPic extends pictureWithMask
	{
		public var screen:SurfSelect;
		public var l:Label;
		public var text:String;
		public var isSelected:Boolean;
		
		public function SurfSelectPic(p_main:Main, p_x:Number, p_y:Number, s:String, p_text:String, p_length:Number, p_screen:SurfSelect, p_defaultIndex:int = 10)
		{
			super(p_main, p_x, p_y, s, p_length, p_defaultIndex);
			screen = p_screen;
			text = p_text;
			l = new Label(main, positionX, positionY + 225, text, 35, 200, true);
			masksprite.addEventListener(MouseEvent.MOUSE_MOVE, showSelection);
			masksprite.addEventListener(MouseEvent.MOUSE_OUT, hideSelection);
		}
		
		public function showSelection(e:Event = null):void
		{
			main.graphics.beginFill(0x0000FF, 0.7);
			main.graphics.drawRect(sprite.x - 10, sprite.y - 10, myLoader.width * sprite.scaleX + 20, myLoader.height * sprite.scaleY + 20);
			main.graphics.endFill();
			main.graphics.beginFill(0xFFFFFF, 1);
			main.graphics.drawRect(sprite.x - 5, sprite.y - 5, myLoader.width * sprite.scaleX + 10, myLoader.height * sprite.scaleY + 10);
			main.graphics.endFill();
		}
		
		public function hideSelection(e:Event = null):void
		{
			main.graphics.beginFill(0xFFFFFF, 1);
			main.graphics.drawRect(sprite.x - 10, sprite.y - 10, myLoader.width * sprite.scaleX + 20, myLoader.height * sprite.scaleY + 20);
			main.graphics.endFill();
		}
		
		public override function move(e:MouseEvent = null):void
		{
			l.text.textColor = 0x8746FF;
		}
		
		public override function out(e:MouseEvent = null):void
		{
			l.text.textColor = 0;
		}
		
		public override function click(e:MouseEvent = null):void
		{
			isSelected = true;
			//new picture(main, positionX, positionY, "assets/Surf/s2.png", 150);
			screen.hideplate();
			screen.selected();
			screen.truePic.masksprite.removeEventListener(MouseEvent.CLICK, screen.truePic.click);
			screen.falsePic.masksprite.removeEventListener(MouseEvent.CLICK, screen.falsePic.click);
		}
	}

}