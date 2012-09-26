package  
{
	import flash.events.Event;
	/**
	 * ...
	 * @author wei
	 */
	public class barChart 
	{
		public var main:Main;
		public var bars:Array = new Array();
		public var values:Array = new Array();
		public var positionX:Number;
		public var positionY:Number;
		public var type:int;
		public var isRemoved:Boolean = true;
		public var maxValue:Number;
		
		public function barChart(p_main:Main,p_type:int) 
		{
			main = p_main;
			positionX = 250;
			positionY = 200;
			type = p_type;
		}
		
		public function addBar(p_value:Number,p_name:String):void
		{
			values.push(p_value);
			bars.push(new bar(main, positionX, positionY,p_name,type));
			positionY += 70;
		}
		
		public function setMaxValue(m:Number):void
		{
			maxValue = m;
		}
		
		public function drawBars():void
		{
			isRemoved = false;
			maxValue = 0;
			for (var i:int = 0; i < values.length; i++ )
			{
				if (values[i] > maxValue)
				{
					maxValue = values[i];
				}
			}

			for (i = 0; i < bars.length; i++ )
			{
				bars[i].drawBar(values[i],values[i]/maxValue);
			}
		}
		
		public function update(e:Event):void
		{
			for (var i:int = 0; i < bars.length; i++ )
			{
				bars[i].update();
			}
		}
		
		public function remove():void
		{
			if (isRemoved)
				return;
			for (var i:int = 0; i < bars.length; i++ )
			{
				bars[i].remove();
			}
			bars.splice(0, bars.length);
			values.splice(0, values.length);
			positionX = 250;
			positionY = 200;
		}
		
	}

}