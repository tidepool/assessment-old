package  
{
	import flash.display.BitmapData;
	import flash.display.DisplayObject;
	import flash.display.GradientType;
	import flash.display.MovieClip;
	import flash.display.SpreadMethod;
	import flash.display.Sprite;
	import flash.geom.Matrix;
	import flash.text.AntiAliasType;
	import flash.text.GridFitType;
	import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
	import flash.text.TextFormat;
	
	/**
	 * ...
	 * @author wei
	 */
	public class subarea extends MovieClip
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
		
		public var isActive:Boolean;
		public var lastStatus:Boolean;
		
		public var text:TextField = new TextField();
		public var sprite:Sprite = new Sprite();
		public var map:BitmapData;
		
		public var aname:String;
		

		
		public function subarea(p_main:Main,p_chart:donutchart,p_color:uint,p_value:Number,p_name:String) 
		{
			main = p_main;
			chart = p_chart;
			color = p_color;
			value = p_value;
			isActive = false;
			lastStatus = false;
			
			main.addChild(text);
			aname = p_name;
			
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
				text.x = chart.positionX + Math.cos((startRad + endRad+0.05) / 2) * (chart.r * 1.25 + text.textWidth / 2);
				text.y = chart.positionY + Math.sin((startRad + endRad+0.05) / 2) * (chart.r * 1.25 + text.textWidth / 2);
				text.rotation = (startRad + endRad) / 2 / Math.PI / 2 * 360+180;
			}
			else
			{
				text.x = chart.positionX + Math.cos((startRad + endRad-0.05) / 2) * (chart.r * 1.25 - text.textWidth / 2);
				text.y = chart.positionY + Math.sin((startRad + endRad-0.05) / 2) * (chart.r * 1.25 - text.textWidth / 2);
				text.rotation = (startRad + endRad) / 2 / Math.PI / 2 * 360;
			}
			
		}
		
		public function showSelectedText():void
		{
			text.embedFonts = true;
			text.antiAliasType = AntiAliasType.ADVANCED;
			text.defaultTextFormat = new TextFormat("fontName", 20);
			text.autoSize = TextFieldAutoSize.LEFT;
			text.text = aname+" "+(int)(100*(endRad-startRad)/Math.PI/2)+"%";
			
			if ((startRad + endRad) / 2 > Math.PI / 2 && (startRad + endRad) / 2 <  Math.PI * 1.5)
			{
				text.x = chart.positionX + Math.cos((startRad + endRad+0.05) / 2) * (chart.r * 1.5 + text.textWidth / 2);
				text.y = chart.positionY + Math.sin((startRad + endRad+0.05) / 2) * (chart.r * 1.5 + text.textWidth / 2);
				text.rotation = (startRad + endRad) / 2 / Math.PI / 2 * 360+180;
			}
			else
			{
				text.x = chart.positionX + Math.cos((startRad + endRad-0.05) / 2) * (chart.r * 1.5 - text.textWidth / 2);
				text.y = chart.positionY + Math.sin((startRad + endRad-0.05) / 2) * (chart.r * 1.5 - text.textWidth / 2);
				text.rotation = (startRad + endRad) / 2 / Math.PI / 2 * 360;
			}
			
		}
		
	
		
		public function draw():void
		{
			render(startRad, endRad, color, chart.r * 1.5,chart.r);

			showText();
		}
		
		public function drawSelected():void
		{
		//	clearFrame(startRad, endRad, color, chart.r * 1.5);
			render(startRad, endRad, color, chart.r * 2,chart.r);
		}
		
		public function render(a:Number,b:Number,color:uint,p_r:Number,p_r1:Number):void
		{
			
			main.graphics.lineStyle(null,0xFFFFFF,1);
			main.graphics.moveTo(chart.positionX + Math.cos(a)*p_r, chart.positionY + Math.sin(a)*p_r);
			for (var i:Number = a; i < b ; i =i+0.1 )
			{
				main.graphics.lineTo(chart.positionX + Math.cos(i)*p_r, chart.positionY + Math.sin(i)*p_r);
			}
			main.graphics.lineTo(chart.positionX + Math.cos(b) * p_r, chart.positionY + Math.sin(b) * p_r);
			
			main.graphics.lineTo(chart.positionX + Math.cos(b)*p_r1, chart.positionY + Math.sin(b)*p_r1);
			for (var i:Number = b; i >a ; i =i-0.1 )
			{
				main.graphics.lineTo(chart.positionX + Math.cos(i)*p_r1, chart.positionY + Math.sin(i)*p_r1);
			}
			main.graphics.lineTo(chart.positionX + Math.cos(a) * p_r1, chart.positionY + Math.sin(a) * p_r1);
				
			
			
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
			for (var i:Number = a; i < b ; i =i+0.1 )
			{
				main.graphics.lineTo(chart.positionX + Math.cos(i)*p_r, chart.positionY + Math.sin(i)*p_r);
			}
			main.graphics.lineTo(chart.positionX + Math.cos(b) * p_r, chart.positionY + Math.sin(b) * p_r);
			
			main.graphics.lineTo(chart.positionX + Math.cos(b)*p_r1, chart.positionY + Math.sin(b)*p_r1);
			for (var i:Number = b; i >a ; i =i-0.1 )
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
			var p_r:Number = chart.r ;
			var p_r1:Number = chart.r*2;
			main.graphics.beginFill(0xFFFFFF, 1);
	
			
			
			main.graphics.moveTo(chart.positionX + Math.cos(a)*p_r, chart.positionY + Math.sin(a)*p_r);
			for (var i:Number = a; i < b ; i =i+0.1 )
			{
				main.graphics.lineTo(chart.positionX + Math.cos(i)*p_r, chart.positionY + Math.sin(i)*p_r);
			}
			main.graphics.lineTo(chart.positionX + Math.cos(b) * p_r, chart.positionY + Math.sin(b) * p_r);
			
			main.graphics.lineTo(chart.positionX + Math.cos(b)*p_r1, chart.positionY + Math.sin(b)*p_r1);
			for (var i:Number = b; i >a ; i =i-0.1 )
			{
				main.graphics.lineTo(chart.positionX + Math.cos(i)*p_r1, chart.positionY + Math.sin(i)*p_r1);
			}
			main.graphics.lineTo(chart.positionX + Math.cos(a) * p_r1, chart.positionY + Math.sin(a) * p_r1);
			
			
			main.graphics.endFill();
		}
		
		public function checkStatus():void
		{
			if (chart.mouseRad >= startRad && chart.mouseRad <= endRad)
			{
				if (isActive == false)
				{
					if ( chart.mouseR >= chart.r  && chart.mouseR <= chart.r*1.5)
					{
						isActive = true;
					}
					else
					{
						isActive = false;
					}
				}
				else
				{
					if ( chart.mouseR >= chart.r  && chart.mouseR <= chart.r*2)
					{
						isActive = true;
					}
					else
					{
						isActive = false;
					}
				}
			}
			else
			{
				isActive = false;
			}
			
			
		}
		
		public function reDraw():void
		{
			
			if (lastStatus != isActive)
			{
				if (isActive)
				{
					render(startRad, endRad, color, chart.r * 2, chart.r);
					showSelectedText();
				}
				else
				{
					clear();
					render(startRad, endRad, color, chart.r * 1.5, chart.r);
					showText();
				}
			}
			
		}
		
		
	}

}