package 
{
	import flash.display.GradientType;
	import flash.display.Loader;
	import flash.display.SpreadMethod;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.geom.Matrix;
	import flash.net.URLRequest;
	
	/**
	 * ...
	 * @author wei
	 */
	public class donutchart extends Sprite 
	{
		public var areas:Array = new Array();
		public var r:Number;
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var mouseRad:Number;
		public var mouseR:Number;
		
		public var lastMouseX:Number;
		public var lastMouseY:Number;
		
		
		public function donutchart(p_main:Main)
		{
			positionX = 1100;
			positionY = 500;
			main = p_main;
			r = 200;
		}
		
		public function update(e:Event):void
		{
			if (mouseX == lastMouseX && mouseY == lastMouseY)
			{
				return;
			}
			mouseR = Math.sqrt((mouseX - positionX) * (mouseX - positionX) + (mouseY - positionY) * (mouseY - positionY));

			
			calculateMouseRad();
			
			for (var i:int = 0; i < areas.length; i++ )
			{
				areas[i].update();
			}
			lastMouseX = mouseX;
			lastMouseY = mouseY;
		}
		
		public function addArea(p_color:uint,p_value:Number,p_name:String):void
		{
			areas.push(new area(main,this,p_color,p_value,p_name));
		}
		
		public function addSubArea(p_color:uint,p_value:Number,p_name:String):void
		{
			areas[areas.length-1].subAreas.push(new subarea(main,this,p_color,p_value,p_name));
		}
		
		public function calculateArea():void
		{
			var total:Number = 0;
			for (var i:int = 0; i < areas.length; i++ )
			{
				total += areas[i].value;
			}
			for ( i = 0; i < areas.length; i++ )
			{
				areas[i].value= areas[i].value/total;
			}
			var start:Number = 0;
			for ( i = 0; i < areas.length; i++ )
			{
				areas[i].startRad = start;
				areas[i].endRad = start + Math.PI * 2 * areas[i].value;
				start = areas[i].endRad;
			}
		}
		
		public function showArea():void
		{
			drawShadow();
			calculateArea();
			for (var i:int = 0; i < areas.length; i++ )
			{
				areas[i].draw();
			}
			main.graphics.beginFill(0xFFFFFF, 1);
			main.graphics.drawCircle(positionX, positionY, r / 2);
			main.graphics.endFill();
		}
		
		
		public function drawShadow():void
		{
			main.graphics.beginFill(0, 0.06);
			main.graphics.drawCircle(positionX+1, positionY+1, r+2);
			main.graphics.endFill();
		}
		
		
		public function calculateMouseRad():void
		{
			var originalX:Number = positionX;
			var originalY:Number = positionY;
			
			var mouseX:Number = main.mouseX;
			var mouseY:Number = main.mouseY;
			
			if (mouseY - originalY == 0)
			{
				if (mouseX - originalX > 0)
				{
					mouseRad=Math.PI*2;
				}
				else
				{
					mouseRad=Math.PI;
				}
			}
			else
			{
				
				if ((mouseY - originalY) < 0)
				{
					mouseRad=Math.acos((mouseX - originalX)/mouseR  );
				}
				else
				{
					mouseRad=Math.PI*2-Math.acos((mouseX - originalX)/ mouseR);
				}
			}
			mouseRad = Math.PI * 2 - mouseRad;
			
		}
		
	}
	
}