package  
{
	import flash.events.Event;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	
	public class RadarGraph 
	{
		public var positionX:Number;
		public var positionY:Number;
		public var values:Array = new Array();
		public var scaleX:Number = 800;
		public var scaleY:Number = 500;
		public var main:Main;
		public var userData:Array = new Array();
		
		private var lines:Array = new Array();
		
		public function RadarGraph(p_main:Main,px:Number,py:Number) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			
			new GenerateData(main, this);
			addLines();
		}
	
		public function addLines():void
		{
			lines.push(new RadarLine(main, this, positionX, positionY, 60,  55, "Personality", 0, 0x008E00));
			lines.push(new RadarLine(main, this, positionX, positionY, 120, 72, "Values", 1, 0xB2B300));
			lines.push(new RadarLine(main, this, positionX, positionY, 180, 74, "Interests", 0, 0x00248E));
			lines.push(new RadarLine(main, this, positionX, positionY, 240, 85, "Motivation", 1, 0xB20000));
			lines.push(new RadarLine(main, this, positionX, positionY, 300, 45, "Resilience", 0, 0x24006B));
			lines.push(new RadarLine(main, this, positionX, positionY, 360, 24, "Projective", 1, 0xB25900));			
			drawIdeal();
		}
		
		public function drawIdeal():void
		{
			main.graphics.clear();
			for (var i:int=0; i < lines.length-1; i++ )
			{
				lines[i].drawLine();
				main.graphics.beginFill(0x0000FF);
				main.graphics.lineStyle(4, 0x0000FF,1);
				main.graphics.moveTo(lines[i].point.x, lines[i].point.y);
				main.graphics.lineTo(lines[i+1].point.x, lines[i+1].point.y);
				main.graphics.endFill();
			}			
				lines[5].drawLine();
				main.graphics.beginFill(0x0000FF);
				main.graphics.lineStyle(4, 0x0000FF,1);
				main.graphics.moveTo(lines[5].point.x, lines[5].point.y);
				main.graphics.lineTo(lines[0].point.x, lines[0].point.y);
				main.graphics.endFill();
		}
		
		private function drawPolygon():void
		{
			drawIdeal();
			for (var i:int=0; i < lines.length-1; i++ )
			{
				main.graphics.beginFill(0x0000FF);
				main.graphics.lineStyle(4, 0x0000FF,1);
				main.graphics.moveTo(lines[i].point.x, lines[i].point.y);
				main.graphics.lineTo(lines[i+1].point.x, lines[i+1].point.y);
				main.graphics.endFill();
			}			
				main.graphics.moveTo(lines[5].point.x, lines[5].point.y);
				main.graphics.lineTo(lines[0].point.x, lines[0].point.y);
		}
		
		public function createData():void
		{
			
		}
		
		public function update():void
		{			
			
		}
	}

}