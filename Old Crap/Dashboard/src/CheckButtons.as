package  
{
	import flash.events.Event;
	/**
	 * ...
	 * @author Wei
	 */
	public class CheckButtons 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var buttons:Array = new Array();
		public var statusString:Array = new Array();
		public function CheckButtons(p_main:Main,px:Number,py:Number) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			/*
			buttons.push(new CheckButton(main,this, positionX, positionY,"herh"));
			buttons.push(new CheckButton(main,this, positionX, positionY+80,"thrth"));
			buttons.push(new CheckButton(main,this, positionX, positionY+160,"derhrt"));
			*/
			main.stage.addEventListener(Event.ENTER_FRAME, update);
		}
		
		public function addButton(name:String):void
		{
			buttons.push(new CheckButton(main,this, positionX, positionY+(buttons.length-1)*25,name));
		}
		
		public function update(e:Event):void
		{
		}
		
		public function updateStatus():void
		{
			statusString = new Array();
			for (var i:int = 0; i < buttons.length; i++ )
			{
				if (buttons[i].isSelected)
				{
					statusString.push(buttons[i].name);
				}
			}
		}
	}

}