package  
{
	import flash.display.GradientType;
	import flash.display.Loader;
	import flash.display.SpreadMethod;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.geom.Matrix;
	import flash.net.URLRequest;
	import flash.text.AntiAliasType;
	import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
	import flash.text.TextFormat;
	/**
	 * ...
	 * @author wei
	 */
	public class area 
	{
		[Embed(mimeType = "application/x-font", embedAsCFF = "false",
         systemFont="Courier New",
         fontName = "fontName",
         fontStyle = "normal",
         fontWeight="normal")]   
		static public const EMBED_FONT:Class;
		
		public var color:uint;
		public var main:Main;
		public var chart:donutchart;
		public var value:Number;
		public var startRad:Number;
		public var endRad:Number;
		public var myLoader:Loader = new Loader();
		
		public var subAreas:Array = new Array();
		public var sprite:Sprite = new Sprite();
		
		public var text:TextField = new TextField();
		public var aname:String;
		
		public var isActive:Boolean = false;
		
		public function area(p_main:Main,p_chart:donutchart,p_color:uint,p_value:Number,p_name:String) 
		{
			main = p_main;
			chart = p_chart;
			color = p_color;
			value = p_value;
			aname = p_name;
		
		}
		
		
		public function draw():void
		{
			calculateSubArea();
			for (var i:int = 0; i < subAreas.length; i++ )
			{
				subAreas[i].draw();
			}
			render(startRad, endRad, color, chart.r, chart.r / 2);
			showText();
		}
		
		public function showText():void
		{
			text.embedFonts = true;
			text.antiAliasType = AntiAliasType.ADVANCED;
			text.defaultTextFormat = new TextFormat("fontName", 10);
			text.autoSize = TextFieldAutoSize.LEFT;
			text.text = aname+" "+(int)(100*(endRad-startRad)/Math.PI/2)+"%";
			if ((startRad + endRad) / 2 > Math.PI / 2 && (startRad + endRad) / 2 <  Math.PI * 1.5)
			{
				text.x = chart.positionX + Math.cos((startRad + endRad+0.05) / 2) * (chart.r * 0.75 + text.textWidth / 2);
				text.y = chart.positionY + Math.sin((startRad + endRad+0.05) / 2) * (chart.r * 0.75 + text.textWidth / 2);
				text.rotation = (startRad + endRad) / 2 / Math.PI / 2 * 360+180;
			}
			else
			{
				text.x = chart.positionX + Math.cos((startRad + endRad-0.05) / 2) * (chart.r * 0.75 - text.textWidth / 2);
				text.y = chart.positionY + Math.sin((startRad + endRad-0.05) / 2) * (chart.r * 0.75 - text.textWidth / 2);
				text.rotation = (startRad + endRad) / 2 / Math.PI / 2 * 360;
			}
			
			main.addChild(text);
		}
		
		public function draw1():void
		{
			render(startRad,endRad,color,chart.r,chart.r/2);
		}
		
		public function calculateSubArea():void
		{
			var total:Number = 0;
			for (var i:int = 0; i < subAreas.length; i++ )
			{
				total += subAreas[i].value;
			}
			for ( i = 0; i < subAreas.length; i++ )
			{
				subAreas[i].value= subAreas[i].value/total;
			}
			var start:Number = startRad;
			for ( i = 0; i < subAreas.length; i++ )
			{
				subAreas[i].startRad = start;
				subAreas[i].endRad = start + (endRad-startRad) * subAreas[i].value;
				start = subAreas[i].endRad;
			}
		}
		
		public function render(a:Number,b:Number,color:uint,p_r:Number,p_r1:Number):void
		{
			
			main.graphics.lineStyle(0,0xFFFFFF,1);
			main.graphics.moveTo(chart.positionX, chart.positionY);
			main.graphics.lineTo(chart.positionX + Math.cos(a)*p_r, chart.positionY + Math.sin(a)*p_r);
			for (var i:Number = a; i < b ; i =i+0.1 )
			{
				main.graphics.lineTo(chart.positionX + Math.cos(i)*p_r, chart.positionY + Math.sin(i)*p_r);
			}
			main.graphics.lineTo(chart.positionX + Math.cos(b)*p_r, chart.positionY + Math.sin(b)*p_r);
			main.graphics.lineTo(chart.positionX, chart.positionY);
				
			
			
			var fillType:String = GradientType.LINEAR;
			var colors:Array = [color,0xEEEEEE ];
			var alphas:Array = [1, 1];
			var ratios:Array = [0x00, 0xFF];
			var matr:Matrix = new Matrix();
			matr.createGradientBox(400, 400, 0, chart.positionX+chart.r/2, chart.positionY);
			var spreadMethod:String = SpreadMethod.PAD;
			main.graphics.beginGradientFill(fillType, colors, alphas, ratios, matr, spreadMethod);  
	
			
		//	main.graphics.moveTo(chart.positionX, chart.positionY);
			
			main.graphics.moveTo(chart.positionX + Math.cos(a)*p_r, chart.positionY + Math.sin(a)*p_r);
			for ( i = a; i < b ; i =i+0.1 )
			{
				main.graphics.lineTo(chart.positionX + Math.cos(i)*p_r, chart.positionY + Math.sin(i)*p_r);
			}
			main.graphics.lineTo(chart.positionX + Math.cos(b) * p_r, chart.positionY + Math.sin(b) * p_r);
			
			main.graphics.lineTo(chart.positionX + Math.cos(b)*p_r1, chart.positionY + Math.sin(b)*p_r1);
			for ( i = b; i >a ; i =i-0.1 )
			{
				main.graphics.lineTo(chart.positionX + Math.cos(i)*p_r1, chart.positionY + Math.sin(i)*p_r1);
			}
			main.graphics.lineTo(chart.positionX + Math.cos(a) * p_r1, chart.positionY + Math.sin(a) * p_r1);
			
			
			main.graphics.endFill();
			
		
		}
		
		public function clear():void
		{
			var a:Number = startRad;
			var b:Number = endRad;
			var p_r:Number = chart.r*2;
			main.graphics.beginFill(0xFFFFFF, 1);
	
			
			main.graphics.moveTo(chart.positionX, chart.positionY);
			main.graphics.lineTo(chart.positionX + Math.cos(a)*p_r, chart.positionY + Math.sin(a)*p_r);
			for (var i:Number = a; i < b ; i =i+0.1 )
			{
				main.graphics.lineTo(chart.positionX + Math.cos(i)*p_r, chart.positionY + Math.sin(i)*p_r);
			}
			main.graphics.lineTo(chart.positionX + Math.cos(b)*p_r, chart.positionY + Math.sin(b)*p_r);
			main.graphics.lineTo(chart.positionX, chart.positionY);
			
			main.graphics.endFill();
		}
		
		public function update():void
		{
			isActive = false;
			if (chart.mouseRad > startRad && chart.mouseRad < endRad )
			{
				if(chart.mouseR > chart.r * 0.5 && chart.mouseR < chart.r)
				{
					isActive = true;
					for ( i = 0; i < subAreas.length; i++ )
					{
						subAreas[i].isActive = true;
					}
				}
				else
				{
					for ( i = 0; i < subAreas.length; i++ )
					{
						subAreas[i].checkStatus();
					}
				}
			}
			else
			{
				for ( i = 0; i < subAreas.length; i++ )
				{
					subAreas[i].isActive = false;
				}
			}
			
			
			for (var i:int = 0; i < subAreas.length; i++ )
			{
				subAreas[i].reDraw();
			}
			
			for ( i = 0; i < subAreas.length; i++ )
			{
				subAreas[i].lastStatus = subAreas[i].isActive;
			}
		}
		
	}

}