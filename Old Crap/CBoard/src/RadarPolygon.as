package  
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.geom.Point;
	import flash.events.MouseEvent;
	
	public class RadarPolygon
	{
		public var index:int;
		public var point:Point;
		public var origin:Point;
		
		private var main:Main;
		private var positionX:Number;
		private var positionY:Number;
		private var angle:Number;		
		private var length:Number = 100;		
		private var color:uint;			
		private var radar:RadarGraph;
		private var scale:Number;
		private var value:Number;
		
		public function RadarPolygon(p_main:Main, r:RadarGraph, px:Number, py:Number, s:Number, v:Number, degrees:Number, i:int = -1, p_color:uint=0x00FF00)
		{
			main = p_main;
			positionX = px;
			positionY = py;
			color = p_color;
			index = i;
			radar = r;
			scale = s;
			value = v*7;
			angle = degrees * Math.PI / 180;
			origin = new Point(positionX, positionY);
			point = new Point((value * Math.cos(angle) * scale) + positionX, (value * Math.sin(angle) * scale) + positionY);
		}
		
		public function update():void
		{	
			//drawLine();
		}		
		
	
		public function drawPolygon(array:Array):void
		{
			var verticies:Vector.<Number> = new Vector.<Number>();
			
			verticies.push(point.x);			
			verticies.push(point.y);
			
			if (index == array.length - 3)
			{
				verticies.push(array[index+1].point.x);	
				verticies.push(array[index+1].point.y);	
				verticies.push(array[0].point.x);	
				verticies.push(array[0].point.y);	
			}
			else if (index == array.length - 2)
			{
				verticies.push(array[index+1].point.x);	
				verticies.push(array[index+1].point.y);	
				verticies.push(array[1].point.x);	
				verticies.push(array[1].point.y);	
			}
			else if (index == radar.otherScore.length - 1)
			{
				verticies.push(array[0].point.x);	
				verticies.push(array[0].point.y);	
				verticies.push(array[2].point.x);	
				verticies.push(array[2].point.y);	
			}
			else
			{
				verticies.push(array[index +1].point.x);	
				verticies.push(array[index +1].point.y);	
				verticies.push(array[index +3].point.x);	
				verticies.push(array[index +3].point.y);	
			}
			radar.sprite.graphics.beginFill(0x00CC00, 1);
			radar.sprite.graphics.drawTriangles(verticies);
			radar.sprite.graphics.endFill();
		}
		
		
		public function drawLine(color:uint,array:Array):void
		{
			radar.sprite.graphics.beginFill(color,1);
			radar.sprite.graphics.lineStyle(3,color,1);
			if (index == array.length - 1)
			{
				
				radar.sprite.graphics.moveTo(point.x, point.y);
				radar.sprite.graphics.lineTo(array[0].point.x, array[0].point.y);
			}
			else
			{
				radar.sprite.graphics.moveTo(point.x, point.y);
				radar.sprite.graphics.lineTo(array[index + 1].point.x, array[index + 1].point.y);
			}
			radar.sprite.graphics.endFill();			
		}
		
		public function displayText():void
		{
			
		}
		
	}

}