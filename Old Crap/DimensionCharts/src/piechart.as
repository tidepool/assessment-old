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
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.text.AntiAliasType;
	import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
	import flash.text.TextFormat;
	
	/**
	 * ...
	 * @author wei
	 */
	public class piechart extends Sprite 
	{
		[Embed(mimeType = "application/x-font", embedAsCFF = "false",
         systemFont="Times New Roman",
         fontName = "fontName",
         fontStyle = "normal",
         fontWeight = "normal")] 
		 static public const EMBED_FONT:Class;
		
		public var texts:Array = new Array();   
		public var pictures:Array = new Array();
		public var color:Array = new Array();
		public var r:Number;
		public var main:Main;
		public var weight:Array = new Array();
		
		public var positionX:Number;
		public var positionY:Number;
		
		public var length:int;
		
		public var strings:Array = new Array();
		public var maskPic:picture;
		public var mouseRad:Number;
		public var currentIndex:Number;
		
		public var cType:int;
		
		
		public var xml:XML;
		
		public function piechart(p_main:Main,type:int=1)
		{
			
			main = p_main;
			cType = type;
			
			 
			
			var childNum:int = 0;
			if (cType == 1)
			{
				strings.push( "Artistic");
				strings.push( "Conventional");
				strings.push( "Enterprising");
				strings.push( "Investigative");
				strings.push( "Realistic");
				strings.push( "Social");
				
				r = 150;
				positionX = 1150;
				positionY = 200;
				length = 6;
				childNum = 0;
			}
			else
			{
				strings.push( "Achievement");
				strings.push( "Challenge");
				strings.push( "Independence");
				strings.push( "Money");
				strings.push( "Power");
				strings.push( "Recognition");
				strings.push( "Service to Others");
				strings.push( "Variety");
				r = 150;
				positionX = 420;
				positionY = 550;
				length = 8;
				childNum = 2;
			}
			
			maskPic = new picture(main, positionX, positionY, "assets/DimensionCharts/mask.png", r * 2.5);
			maskPic.sprite.addEventListener(MouseEvent.CLICK, click);
			var total:Number=0;
			for (var i:int = 0; i < length; i++ )
			{
				total += int(main.xmlString.children()[childNum].children()[i]) ;
			}
			for ( i = 0; i < length; i++ )
			{
				weight.push(int(main.xmlString.children()[childNum].children()[i])/total);
			}
			total = 0;
			for ( i = 0; i < length-1; i++ )
			{
				total += weight[i];
				pictures.push(new piechartButton(main, this, 2 * Math.PI * total, i));
			}
			for ( i = 0; i < length; i++ )
			{
				texts.push(new TextField());
			}
			
			
			for ( i = 0; i < length; i++ )
			{
				main.addChild(texts[i]);
			}
			
			
			color.push(0xFF3282);
			color.push(0x62FF85);
			color.push(0x7327FF);
			color.push(0xFF5800);
			color.push(0xFFFF27);
			color.push(0x628451);
			color.push(0xFF9436);
			color.push(0x74FFFF);
			
			drawShadow();
			redraw();
			
		//	main.addEventListener(Event.ENTER_FRAME, update);
		}
		
		
		public	function urlLoader_complete(evt:Event):void {
				xml = new XML(evt.currentTarget.data);
				
			
			}
		
		
		public function update(e:Event=null):void
		{
			if (Math.sqrt((main.mouseX - positionX) * (main.mouseX - positionX) + (main.mouseY - positionY) * (main.mouseY - positionY)) > r * 1.1)
			{
				var flag:Boolean = false;
				for (var i:int = 0; i < pictures.length; i++ )
				{
					if (pictures[i].isDragging )
					{
						flag = true;
					}
				}
				for ( i = 0; i < pictures.length; i++ )
				{
					if (!flag)
					{
						pictures[i].sprite.alpha = 0;
					}
				}
			}
			else
			{
				for (var i:int = 0; i < pictures.length; i++ )
				{
					pictures[i].sprite.alpha = 1;
				}
			}
			
		}
		
		public function click(e:Event):void
		{
			calculateMouseRad();
			
			if (mouseRad >= 0 && mouseRad <= pictures[0].rad)
			{
				currentIndex = -1;
			}
			else if (mouseRad >= pictures[pictures.length - 1].rad && mouseRad <= Math.PI * 2)
			{
				currentIndex = pictures.length -1;
			}
			else
			{
				for (var i:int = 0; i < pictures.length-1; i++ )
				{
					if (mouseRad >= pictures[i].rad && mouseRad <= pictures[i + 1].rad)
					{
						currentIndex = i;
					}
				}
			}
			
			
			if (Math.sqrt((main.mouseX - positionX) * (main.mouseX - positionX) + (main.mouseY - positionY) * (main.mouseY - positionY)) < r * 1.1)
			{
				main.popWindow(strings[currentIndex+1]);
			}
		}
		
		public function calculateMouseRad():void
		{
			var mouseR:Number = Math.sqrt((main.mouseX - positionX) * (main.mouseX - positionX) + (main.mouseY - positionY) * (main.mouseY - positionY));
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
		
		public function redraw():void
		{
			
			for (var i:int = 0; i < pictures.length; i++ )
			{
				pictures[i].update();
			}
			render(0, pictures[0].rad, color[0]);
			showText(0,0,pictures[0].rad);
			
			for ( i = 0; i < pictures.length-1; i++ )
			{
				render(pictures[i].rad, pictures[i + 1].rad, color[i +1]);
				showText(i+1,pictures[i].rad, pictures[i + 1].rad);
			}
			
			render(pictures[pictures.length - 1].rad, Math.PI * 2, color[pictures.length ]);
			showText(texts.length-1,pictures[pictures.length - 1].rad, Math.PI * 2);
			
			
		}
		
		public function showText(index:int,startRad:Number,endRad:Number):void
		{
			texts[index].embedFonts = true;
			texts[index].antiAliasType = AntiAliasType.ADVANCED;
			texts[index].defaultTextFormat = new TextFormat("fontName", 12);
			texts[index].autoSize = TextFieldAutoSize.LEFT;
			//text.text = aname+" "+(int)(100*(endRad-startRad)/Math.PI/2)+"%";
			texts[index].text = strings[index]+ " "+(int)((endRad-startRad)/Math.PI/2*100)+"%";
			
			if ((startRad + endRad) / 2 > Math.PI / 2 && (startRad + endRad) / 2 <  Math.PI * 1.5)
			{
				texts[index].x = positionX + Math.cos((startRad + endRad+0.05) / 2) * (r*0.97 );
				texts[index].y = positionY + Math.sin((startRad + endRad+0.05) / 2) * (r*0.97);
				texts[index].rotation = (startRad + endRad) / 2 / Math.PI / 2 * 360+180;
			}
			else
			{
				texts[index].x = positionX + Math.cos((startRad + endRad-0.05) / 2) * (r*0.97 - texts[index].textWidth);
				texts[index].y = positionY + Math.sin((startRad + endRad-0.05) / 2) * (r*0.97  - texts[index].textWidth);
				texts[index].rotation = (startRad + endRad) / 2 / Math.PI / 2 * 360;
			}
			
		}
		
		public function render(a:Number,b:Number,color:uint):void
		{
			var fillType:String = GradientType.LINEAR;
			var colors:Array = [color,0xEEEEEE ];
			var alphas:Array = [1, 1];
			var ratios:Array = [0x00, 0xFF];
			var matr:Matrix = new Matrix();
			matr.createGradientBox(r*2, r*2, 0, positionX, positionY);
			var spreadMethod:String = SpreadMethod.PAD;
			main.graphics.beginGradientFill(fillType, colors, alphas, ratios, matr, spreadMethod);
			
			main.graphics.moveTo(positionX, positionY);
			main.graphics.lineTo(positionX + Math.cos(a)*r, positionY + Math.sin(a)*r);
			for (var i:Number = a; i < b ; i =i+0.1 )
			{
				main.graphics.lineTo(positionX + Math.cos(i)*r, positionY + Math.sin(i)*r);
			}
			main.graphics.lineTo(positionX + Math.cos(b)*r, positionY + Math.sin(b)*r);
			main.graphics.lineTo(positionX, positionY);
			
			main.graphics.endFill();
		}
		
		public function drawShadow():void
		{
			main.graphics.beginFill(0, 0.06);
			main.graphics.drawCircle(positionX+1, positionY+1, r+2);
			main.graphics.endFill();
		}
		
	}
	
}