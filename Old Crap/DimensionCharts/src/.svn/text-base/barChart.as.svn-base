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
		public var max:Number;
		
		public function barChart(p_main:Main) 
		{
			main = p_main;
			positionX = 1150;
			positionY = 450;
		}
		
		public function addBar(p_value:Number,p_name:String):void
		{
			values.push(p_value);
			bars.push(new bar(main, positionX, positionY,p_name));
			positionY += 70;
		}
		
		public function drawBars():void
		{
			var totalValue:Number = 0;
			for (var i:int = 0; i < values.length; i++ )
			{
				if (values[i] > totalValue)
				{
					totalValue = values[i];
				}
			}
			for (i = 0; i < values.length; i++ )
			{
				values[i]= values[i]/100;
			}
			max = totalValue;
			for (i = 0; i < bars.length; i++ )
			{
				bars[i].drawBar(values[i],max);
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
			for (var i:int = 0; i < bars.length; i++ )
			{
				bars[i].remove();
			}
			bars.splice(0, bars.length);
			values.splice(0, values.length);
			positionX = 350;
			positionY = 200;
		}
		
	}

}