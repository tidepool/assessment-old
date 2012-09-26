package  
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.geom.Point;
	import flash.events.MouseEvent;
	
	public class RadarLine 
	{
		public var index:int;
		public var point:Point;
		public var origin:Point;
		
		private var main:Main;
		private var positionX:Number;
		private var positionY:Number;
		private var endPoint:Point;
		private var stringPoint:Point;
		private var angle:Number;		
		private var length:Number = 100;	
		private var name:String;		
		private var nameLabel:Label;
		private var radar:RadarGraph;
		private var scale:Number;
		
		public function RadarLine(p_main:Main, r:RadarGraph, px:Number, py:Number, s:Number, degrees:Number, p_name:String="", i:int = -1)
		{
			main = p_main;
			positionX = px;
			positionY = py;
			name = p_name;
			index = i;
			radar = r;
			scale = s;
			angle = degrees * Math.PI / 180;
			origin = new Point(positionX, positionY);
			endPoint = new Point((length * Math.cos(angle) * scale) + positionX, (length * Math.sin(angle) * scale) + positionY);
			stringPoint = new Point(((length + 5) * Math.cos(angle) * scale) + positionX , ((length + 5) * Math.sin(angle) * scale) + positionY );
 
			if (name == "Extroversion")
			{
				stringPoint.x -= 90;
			}
			else if (name == "Emotional Stability")
			{
				stringPoint.x -= 125;
			}
			
			nameLabel = new Label(main, stringPoint.x, stringPoint.y,name,14,200,false);
		}		
		public function drawDegree():void
		{
			main.graphics.beginFill(0x000000);
			main.graphics.lineStyle(2, 0, .75);
			main.graphics.moveTo(positionX, positionY);
			main.graphics.lineTo(endPoint.x, endPoint.y);
			main.graphics.endFill();			
		}		
	}

}