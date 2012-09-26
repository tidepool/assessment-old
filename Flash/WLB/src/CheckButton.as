package  
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	
	public class CheckButton 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var isSelected:Boolean=false;
		public var pic1:picture;
		public var pic2:picture;
		public var maskPic:picture;
		public var screen:Map;
		
		public function CheckButton(p_main:Main,p_screen:Map,px:Number,py:Number) 
		{
			main = p_main;
			screen = p_screen;
			positionX = px;
			positionY = py;
			pic1 = new picture(main, px, py+50, "assets/Radio_selected.png", 25);
			pic2 = new picture(main, px, py+50, "assets/Radio_unselected.png", 25);
			maskPic = new picture(main, px, py+50, "assets/mask.png", 25);
			maskPic.sprite.addEventListener(MouseEvent.CLICK, click);
			main.addEventListener(Event.ENTER_FRAME, update);
		}
		
		
		public function click(e:Event = null):void
		{
			/*
			if (isSelected)
			{
				isSelected = false;
			}
			else
			{
				isSelected = true;
			}
			*/
			for (var i:int = 0; i < screen.buttons.length; i++ )
			{
				screen.buttons[i].isSelected = false;
			}
			isSelected = true;
		}
		
		public function update(e:Event=null):void
		{
			if (main.index > 3)
			{
				return;
			}
			/*
			pic1.setPosition(-main.x + positionX, -main.y + positionY+5);
			pic2.setPosition(-main.x + positionX, -main.y + positionY+5);
			maskPic.setPosition( -main.x + positionX, -main.y + positionY + 5);
			*/
			pic1.sprite.x = positionX;
			pic1.sprite.y = positionY;
			pic2.sprite.x = positionX;
			pic2.sprite.y = positionY;
			maskPic.sprite.x = positionX;
			maskPic.sprite.y = positionY;
			
			if (main.contains(maskPic.sprite))
			{
				main.setChildIndex(maskPic.sprite,main.numChildren-1);
			}
			if (isSelected)
			{
				if (main.contains(pic2.sprite))
				{
					main.removeChild(pic2.sprite);
				}
				if (!main.contains(pic1.sprite))
				{
					main.addChild(pic1.sprite);
				}
			}
			else
			{
				if (main.contains(pic1.sprite))
				{
					main.removeChild(pic1.sprite);
				}
				if (!main.contains(pic2.sprite))
				{
					main.addChild(pic2.sprite);
				}
			}
		}
		
	}

}