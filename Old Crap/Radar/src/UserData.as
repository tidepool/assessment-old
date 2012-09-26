package  
{
	import flash.events.MouseEvent;
	import flash.geom.Point;
	public class UserData 
	{
		public var name:String;		
		
		public var interest:int;
		public var personality:int;
		public var values:int;
		public var resilience:int;
		public var motivation:int;
		public var projective:int;
		private var index:int;
		private var label:Label;
		private var main:Main;
		private var radar:RadarGraph;
		
		
		public function UserData(m:Main, rad:RadarGraph, n:String, i:int, per:int, v:int, r:int, mot:int, pro:int, ind:int) 
		{
			name = n;
			interest = i;
			personality = per;
			values = v;
			resilience = r;
			motivation = mot;
			projective = pro;
			index = ind;
			main = m;
			radar = rad;
			
			label = new Label(main, 50, (index * 50) + 15, 25, 150, name, 0);
			label.sprite.addEventListener(MouseEvent.CLICK, onMouseClick);
			label.sprite.addEventListener(MouseEvent.MOUSE_OVER, onMouseOver);
			label.sprite.addEventListener(MouseEvent.MOUSE_OUT, onMouseOut);
		}		
		
		private function drawPolygon():void
		{
			trace(personality + "\t" + values + "\t" + interest + "\t" + motivation + "\t" + resilience + "\t" + projective);
			var scale:int = 3;
			
			var angle:Number = 60 * Math.PI / 180;
			var personalityP:Point = new Point((personality * Math.cos(angle) * scale) + radar.positionX, (personality * Math.sin(angle) * scale) + radar.positionY);
			angle = 120 * Math.PI / 180;
			var valuesP:Point = new Point((values * Math.cos(angle) * scale) + radar.positionX, (values * Math.sin(angle) * scale) + radar.positionY);	
			angle = 180 * Math.PI / 180;
			var interestP:Point = new Point((interest * Math.cos(angle) * scale) + radar.positionX, (interest * Math.sin(angle) * scale) + radar.positionY);	
			angle = 240 * Math.PI / 180;	
			var motivationP:Point = new Point((motivation * Math.cos(angle) * scale) + radar.positionX, (motivation * Math.sin(angle) * scale) + radar.positionY);
			angle = 300 * Math.PI / 180;	
			var resilienceP:Point = new Point((resilience * Math.cos(angle) * scale) + radar.positionX, (resilience * Math.sin(angle) * scale) + radar.positionY);
			angle = 360 * Math.PI / 180;
			var projectiveP:Point = new Point((projective * Math.cos(angle) * scale) + radar.positionX, (projective * Math.sin(angle) * scale) + radar.positionY);
			
			//point = new Point((value * Math.cos(angle) * scale) + positionX, (value * Math.sin(angle) * scale) + positionY);
			/*
			lines.push(new RadarLine(main, this, positionX, positionY, 60,  55, "Personality", 0, 0x008E00));
			lines.push(new RadarLine(main, this, positionX, positionY, 120, 72, "Values", 1, 0xB2B300));
			lines.push(new RadarLine(main, this, positionX, positionY, 180, 74, "Interests", 0, 0x00248E));
			lines.push(new RadarLine(main, this, positionX, positionY, 240, 85, "Motivation", 1, 0xB20000));
			lines.push(new RadarLine(main, this, positionX, positionY, 300, 45, "Resilience", 0, 0x24006B));
			lines.push(new RadarLine(main, this, positionX, positionY, 360, 24, "Projective", 1, 0xB25900));	
			*/
			radar.drawIdeal();
			
			main.graphics.beginFill(0xFF0000);
			main.graphics.lineStyle(4, 0xFF0000, 1);
			
			main.graphics.moveTo(personalityP.x, personalityP.y);
			main.graphics.lineTo(valuesP.x, valuesP.y);
			
			main.graphics.moveTo(valuesP.x, valuesP.y);
			main.graphics.lineTo(interestP.x, interestP.y);
			
			main.graphics.moveTo(interestP.x, interestP.y);
			main.graphics.lineTo(motivationP.x, motivationP.y);
			
			main.graphics.moveTo(motivationP.x, motivationP.y);
			main.graphics.lineTo(resilienceP.x, resilienceP.y);
			
			main.graphics.moveTo(resilienceP.x, resilienceP.y);
			main.graphics.lineTo(projectiveP.x, projectiveP.y);
			
			main.graphics.moveTo(projectiveP.x, projectiveP.y);
			main.graphics.lineTo(personalityP.x, personalityP.y);
			
		}
		
		private function onMouseOver(e:MouseEvent):void 
		{
			label.text.textColor = 0x0000FF;
		}
		
		private function onMouseOut(e:MouseEvent) :void
		{
			label.text.textColor = 0x000000;
		}
		private function onMouseClick(e:MouseEvent):void 
		{
			drawPolygon();
			trace("Clicked on: " + name);
		}
	}

}