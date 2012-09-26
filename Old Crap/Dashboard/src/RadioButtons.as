package  
{
	import flash.events.Event;
	/**
	 * ...
	 * @author Wei
	 */
	public class RadioButtons 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var buttons:Array = new Array();
		public var status:int = -1;
		public var statusString:String = "";
		public function RadioButtons(p_main:Main,px:Number,py:Number) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			/*
			buttons.push(new RadioButton(main,this, positionX, positionY,"herh"));
			buttons.push(new RadioButton(main,this, positionX, positionY+80,"thrth"));
			buttons.push(new RadioButton(main,this, positionX, positionY+160,"derhrt"));
			
			buttons[0].isSelected = true;
			*/
			main.stage.addEventListener(Event.ENTER_FRAME, update);
		}
		
		public function addButton(name:String):void
		{
			buttons.push(new RadioButton(main,this, positionX, positionY+(buttons.length-1)*25,name));
		}
		
		public function update(e:Event):void
		{
			trace(statusString);
		}
		public function updateStatus():void
		{
			
			for (var i:int = 0; i < buttons.length; i++ )
			{
				if (buttons[i].isSelected)
				{
					status = i;
					statusString = buttons[i].name;
					break;
				}
			}
		}
	}

}