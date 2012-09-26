package
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.utils.getTimer;
	
	public class SurfMultiPic extends pictureWithMask
	{
		public var screen:SurfMulti;
		public var l:Label;
		public var text:String;
		public var surf:picture;
		public var isselected:Boolean = false;
		public var xmlData:String;
		private var index:int;
		
		public function SurfMultiPic(p_main:Main, p_x:Number, p_y:Number, s:String, p_text:String, p_length:Number, p_screen:SurfMulti, ind:int, p_data:String = "tide")
		{
			super(p_main, p_x, p_y, s, p_length, ind);
			screen = p_screen;
			text = p_text;
			l = new Label(main, positionX, positionY + 150, text, 25, 250, true);
			xmlData = p_data;
			index = ind;
		}
		
		public override function move(e:MouseEvent = null):void
		{
			l.text.textColor = 0x8746FF;
			main.graphics.beginFill(0x0000FF, 0.7);
			main.graphics.drawRect(sprite.x - 10, sprite.y - 10, myLoader.width * sprite.scaleX + 20, myLoader.height * sprite.scaleY + 20);
			main.graphics.endFill();
			main.graphics.beginFill(0xFFFFFF, 1);
			main.graphics.drawRect(sprite.x - 5, sprite.y - 5, myLoader.width * sprite.scaleX + 10, myLoader.height * sprite.scaleY + 10);
			main.graphics.endFill();
		}
		
		public override function out(e:MouseEvent = null):void
		{
			l.text.textColor = 0;
			main.graphics.beginFill(0xFFFFFF, 1);
			main.graphics.drawRect(sprite.x - 10, sprite.y - 10, myLoader.width * sprite.scaleX + 20, myLoader.height * sprite.scaleY + 20);
			main.graphics.endFill();
		}
		
		public override function click(e:MouseEvent = null):void
		{
			screen.recordChanges(index);
			if (isselected)
			{
				isselected = false;
				if (main.contains(surf.sprite))
				{
					main.removeChild(surf.sprite);
				}
			}
			else
			{
				isselected = true;
				surf = new picture(main, positionX, positionY, "assets/Surf/s16.png", 111);
			}
		}
	}

}