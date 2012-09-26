package  
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	/**
	 * ...
	 * @author Wei
	 */
	public class checkButton 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var isSelected:Boolean=false;
		public var pic1:picture;
		public var pic2:picture;
		public var maskPic:picture;
		public function checkButton(p_main:Main,px:Number,py:Number) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			pic1 = new picture(main, px, py+50, "assets/Graph/Radio_selected.png", 25);
			pic2 = new picture(main, px, py+50, "assets/Graph/Radio_unselected.png", 25);
			maskPic = new picture(main, px, py+50, "assets/Graph/mask.png", 25);
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
			for (var i:int = 0; i < main.buttons.length; i++ )
			{
				main.buttons[i].isSelected = false;
			}
			isSelected = true;
		}
		
		public function update(e:Event=null):void
		{
			pic1.setPosition(-main.x + positionX, -main.y + positionY+5);
			pic2.setPosition(-main.x + positionX, -main.y + positionY+5);
			maskPic.setPosition(-main.x + positionX, -main.y + positionY+5);
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