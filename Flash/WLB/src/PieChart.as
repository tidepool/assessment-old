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
	import flash.text.*;
	
	public class PieChart
	{
		[Embed(mimeType="application/x-font",embedAsCFF="false",systemFont="Courier New",fontName="fontName",fontStyle="normal",fontWeight="normal")]
		static public const EMBED_FONT:Class;
		
		public var texts:Array = new Array();
		public var buttonsArea:Array = new Array();
		public var buttons:Array = new Array();
		public var color:Array = new Array();
		public var r:Number;
		public var main:Main;
		public var weight:Array = new Array();
		public var positionX:Number;
		public var positionY:Number;
		public var strings:Array = new Array();
		public var percentage:Array = new Array();
		public var length:int;
		
		private var format1:TextFormat;
		private var pieScreen:PieChartScreen;
		
		public function PieChart(p_main:Main, type:int = 1)
		{
			main = p_main;
			r = 350;
			positionX = 450;
			positionY = 400;
			length = 2;
			//pieScreen = pscrn;
			
			format1 = new TextFormat();
			format1.font = "Arial";
			format1.size = 25;
			format1.bold = true;
			
			var total:Number = 0;
			for (var i:int = 0; i < length; i++)
			{
				total += 1 + 5;
			}
			for (i = 0; i < length; i++)
			{
				weight.push(1 / total * (1 + 5));
			}
			total = 0;
			for (i = 0; i < length - 1; i++)
			{
				total += weight[i];
				buttons.push(new PieChartButton(main, this, 2 * Math.PI * total, i));
			}
			for (i = 0; i < length; i++)
			{
				texts.push(new TextField());
			}
			
			if (type == 1)
			{
				strings.push(" ");
				strings.push(" ");
				strings.push(" ");
				strings.push(" ");
				strings.push(" ");
				strings.push(" ");
				buttonsArea.push(new picture(main, 0, 0, "assets/home.png", 200, this));
				buttonsArea.push(new picture(main, 0, 0, "assets/office.png", 200, this));
			}
			else
			{
				strings.push("Manual Skills");
				strings.push("Math Ability");
				strings.push("Musical Ability");
				strings.push("Understanding of Others");
				strings.push("Managerial Skills");
				strings.push("Office skills");
			}
			
			for (i = 0; i < length; i++)
			{
				main.addChild(texts[i]);
			}
			
			color.push(0x00248E);
			color.push(0x008E00);
			drawShadow();
			redraw();
		
		}
		
		public function update():void
		{
			for (var i:int = 0; i < buttons.length; i++)
			{
				buttons[i].update();
			}
			if (Math.sqrt((main.mouseX - positionX) * (main.mouseX - positionX) + (main.mouseY - positionY) * (main.mouseY - positionY)) > r * 1.1)
			{
				var flag:Boolean = false;
				for (var i:int = 0; i < buttons.length; i++)
				{
					if (buttons[i].isDragging)
					{
						flag = true;
					}
				}
				for (i = 0; i < buttons.length; i++)
				{
					if (!flag)
					{
						buttons[i].sprite.alpha = 0;
					}
				}
			}
			else
			{
				for (i = 0; i < buttons.length; i++)
				{
					buttons[i].sprite.alpha = 1;
				}
			}
		
		}
		
		public function redraw():void
		{
			
			for (var i:int = 0; i < buttons.length; i++)
			{
				buttons[i].update();
			}
			render(0, buttons[0].rad, color[0]);
			showText(0, 0, buttons[0].rad);
			
			for (i = 0; i < buttons.length - 1; i++)
			{
				render(buttons[i].rad, buttons[i + 1].rad, color[i + 1]);
				showText(i + 1, buttons[i].rad, buttons[i + 1].rad);
			}
			
			render(buttons[buttons.length - 1].rad, Math.PI * 2, color[buttons.length]);
			showText(texts.length - 1, buttons[buttons.length - 1].rad, Math.PI * 2);
		
		}
		
		public function showText(index:int, startRad:Number, endRad:Number):void
		{
			
			texts[index].embedFonts = true;
			texts[index].antiAliasType = AntiAliasType.ADVANCED;
			texts[index].defaultTextFormat = new TextFormat("fontName", 26);
			texts[index].autoSize = TextFieldAutoSize.LEFT;
			texts[index].textColor = 0xFFFFFFF;
			//text.text = aname+" "+(int)(100*(endRad-startRad)/Math.PI/2)+"%";
			texts[index].text = strings[index] + " " + Math.round((endRad - startRad) / Math.PI / 2 * 100) + "%";
			percentage[index] = Math.round((endRad - startRad) / Math.PI / 2 * 100);
			//texts[index].setTextFormat(format1);
			if ((startRad + endRad) / 2 > Math.PI / 2 && (startRad + endRad) / 2 < Math.PI * 1.5)
			{
				texts[index].x = positionX + Math.cos((startRad + endRad + 0.05) / 2) * (r * 0.4);
				texts[index].y = positionY + Math.sin((startRad + endRad + 0.05) / 2) * (r * 0.4);
				texts[index].rotation = (startRad + endRad) / 2 / Math.PI / 2 * 360 + 180;
			}
			else
			{
				texts[index].x = positionX + Math.cos((startRad + endRad - 0.05) / 2) * (r * 0.4 - texts[index].textWidth);
				texts[index].y = positionY + Math.sin((startRad + endRad - 0.05) / 2) * (r * 0.4 - texts[index].textWidth);
				texts[index].rotation = (startRad + endRad) / 2 / Math.PI / 2 * 360;
			}
			main.setChildIndex(texts[index], main.numChildren - 1);
			showPicture(index, startRad, endRad);
		}
		
		public function showPicture(index:int, startRad:Number, endRad:Number):void
		{
			
			var scale:Number = endRad - startRad;
			if (scale < 0)
			{
				scale = -scale;
			}
			scale = scale / 3;
			buttonsArea[index].sprite.scaleX = scale;
			buttonsArea[index].sprite.scaleY = scale;
			
			buttonsArea[index].sprite.x = positionX + Math.cos((startRad + endRad + 0.05) / 2) * (r * 0.6) - buttonsArea[index].myLoader.width / 2 * scale;
			buttonsArea[index].sprite.y = positionY + Math.sin((startRad + endRad + 0.05) / 2) * (r * 0.6) - buttonsArea[index].myLoader.height / 2 * scale;
		}
		
		public function render(a:Number, b:Number, color:uint):void
		{
			var fillType:String = GradientType.LINEAR;
			var colors:Array = [color, 0xEEEEEE];
			var alphas:Array = [1, 1];
			var ratios:Array = [0x00, 0xFF];
			var matr:Matrix = new Matrix();
			matr.createGradientBox(r * 2, r * 2, 0, positionX, positionY);
			var spreadMethod:String = SpreadMethod.PAD;
			//main.graphics.beginGradientFill(fillType, colors, alphas, ratios, matr, spreadMethod);
			main.graphics.beginFill(color, 1);
			main.graphics.moveTo(positionX, positionY);
			main.graphics.lineTo(positionX + Math.cos(a) * r, positionY + Math.sin(a) * r);
			for (var i:Number = a; i < b; i = i + 0.1)
			{
				main.graphics.lineTo(positionX + Math.cos(i) * r, positionY + Math.sin(i) * r);
			}
			main.graphics.lineTo(positionX + Math.cos(b) * r, positionY + Math.sin(b) * r);
			main.graphics.lineTo(positionX, positionY);
			
			main.graphics.endFill();
		}
		
		public function drawShadow():void
		{
			main.graphics.beginFill(0, 0.06);
			main.graphics.drawCircle(positionX + 1, positionY + 1, r + 2);
			main.graphics.endFill();
		}
	
	}

}