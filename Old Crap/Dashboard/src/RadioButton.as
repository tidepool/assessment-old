package  
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	/**
	 * ...
	 * @author Wei
	 */
	public class RadioButton 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var isSelected:Boolean=false;
		public var pic1:picture;
		public var pic2:picture;
		public var maskPic:picture;
		public var buttons:RadioButtons;
		public var name:String;
		public function RadioButton(p_main:Main,p_buttons:RadioButtons,px:Number,py:Number,p_name:String="") 
		{
			main = p_main;
			name = p_name;
			buttons = p_buttons;
			positionX = px;
			positionY = py;
			pic1 = new picture(main, px, py, "assets/Radio_selected.png", 15);
			pic2 = new picture(main, px, py, "assets/Radio_unselected.png", 15);
			maskPic = new picture(main, px, py, "assets/mask.png", 15);
			maskPic.sprite.addEventListener(MouseEvent.CLICK, click);
			main.addEventListener(Event.ENTER_FRAME, update);
			new label(main,px+15,py+3,name,15);
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
			for (var i:int = 0; i < buttons.buttons.length; i++ )
			{
				buttons.buttons[i].isSelected = false;
			}
			isSelected = true;
			buttons.updateStatus();
			main.displayData();
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