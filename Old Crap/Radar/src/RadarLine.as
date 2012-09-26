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
		private var color:uint;		
		private var name:String;		
		private var nameLabel:Label;
		private var valueLabel:Label;		
		private var sprite:Sprite = new Sprite();
		private var radar:RadarGraph;
		private var scale:int;
		private var value:Number;
		
		public function RadarLine(p_main:Main, r:RadarGraph, px:Number, py:Number, degrees:Number, v:Number, p_name:String="", i:int = -1, p_color:uint=0x00FF00)
		{
			main = p_main;
			positionX = px;
			positionY = py;
			name = p_name;
			color = p_color;
			index = i;
			radar = r;
			scale = 3;
			value = v;
			angle = degrees * Math.PI / 180;
			origin = new Point(positionX, positionY);
			endPoint = new Point((length * Math.cos(angle) * scale) + positionX, (length * Math.sin(angle) * scale) + positionY);
			stringPoint = new Point(((length + 20) * Math.cos(angle) * scale) + positionX , ((length + 20) * Math.sin(angle) * scale) + positionY );
			point = new Point((value * Math.cos(angle) * scale) + positionX, (value * Math.sin(angle) * scale) + positionY);
 
			var alignment:int;
			if (degrees > 315 || degrees <= 45)
			{
				alignment = 0;
			}
			else if (degrees > 45 && degrees <= 135)
			{
				alignment = 1;
			}
			else if (degrees > 135 && degrees <= 225)
			{
				alignment = 2;
			}
			else if (degrees > 225 && degrees <= 315)
			{
				alignment = 1;
			}
			nameLabel = new Label(main, stringPoint.x, stringPoint.y, 25, 150, p_name, alignment);
			valueLabel = new Label(main, 0, 0, 0, 0, "");
			main.addChild(sprite);			
			sprite.addEventListener(MouseEvent.MOUSE_DOWN, down);
			main.stage.addEventListener(MouseEvent.MOUSE_UP, up);
			//drawLine();
		}
		
		public function update():void
		{	
			//drawLine();
		}		
		
		public function down(e:Event):void
		{
		}
		
		public function up(e:Event):void
		{
		}
		
		public function drawLine():void
		{
			
			main.graphics.beginFill(0x000000);
			main.graphics.lineStyle(2, 0, .75);
			main.graphics.moveTo(positionX, positionY);
			main.graphics.lineTo(endPoint.x, endPoint.y);
			main.graphics.endFill();			
		}
		
		public function displayText():void
		{
			
		}
		
	}

}