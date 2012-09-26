package  
{
	import flash.events.Event;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	/**
	 * ...
	 * @author Wei
	 */
	public class personalityChart 
	{
		public var positionX:Number;
		public var positionY:Number;
		public var scaleX:Number = 500;
		public var scaleY:Number = 120;
		public var numOfYLabel:int = 4;
		public var yLabelDistance:Number;
		public var yLabelOffsetX:Number = -50;
		public var main:Main;
		
		public var xml:XML;
		public function personalityChart(p_main:Main,px:Number,py:Number) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			yLabelDistance = scaleY * 0.8 / (numOfYLabel-1);
			drawLines();
			displayYLabel();
			addBars();
		
		/*
			 
			var urlRequest:URLRequest = new URLRequest("personality.xml");
			 
			var urlLoader:URLLoader = new URLLoader();
			urlLoader.addEventListener(Event.COMPLETE, urlLoader_complete);
			urlLoader.load(urlRequest);
			 */
		}
		
		
		public	function urlLoader_complete(evt:Event):void {
				xml = new XML(evt.currentTarget.data);
				
			addBars();
		}
		
		public function addBars():void
		{
			
		
			new VerticalBar(main, positionX + 50, positionY, main.xmlString.children()[1].children()[0],"Conscientiousness");
			new VerticalBar(main,positionX+150,positionY,main.xmlString.children()[1].children()[1],"Agreeableness",0xFF0000);
			new VerticalBar(main, positionX + 250, positionY, main.xmlString.children()[1].children()[2],"Extroversion",0x0000FF);
			new VerticalBar(main,positionX+350,positionY,main.xmlString.children()[1].children()[3],"Neuroticism",0xFFFF00);
			new VerticalBar(main, positionX + 450, positionY, main.xmlString.children()[1].children()[4],"Openness",0xFF00FF);
		}
		
		public function displayYLabel():void
		{
			
			new label(main, positionX+yLabelOffsetX, positionY + i * yLabelDistance,0 + "");
			for (var i:int=1; i < numOfYLabel; i++ )
			{
				new label(main, positionX+yLabelOffsetX, positionY + i * yLabelDistance,"-"+ i * 30 + "");
				new label(main, positionX+yLabelOffsetX, positionY - i * yLabelDistance, i * 30 + "");
			}
		}
		
		public function drawLines():void
		{
			main.graphics.beginFill(0x00FF00);
			main.graphics.lineStyle(2, 0, .75);
			
			main.graphics.moveTo(positionX, positionY);
			main.graphics.lineTo(positionX, positionY - scaleY);
			
			main.graphics.moveTo(positionX, positionY);
			main.graphics.lineTo(positionX, positionY + scaleY);
			
			main.graphics.moveTo(positionX, positionY);
			main.graphics.lineTo(positionX + scaleX, positionY);
			
			main.graphics.lineStyle(1, 0xaaaaaa, .75);
			for (var i:int=1; i < numOfYLabel; i++ )
			{
				main.graphics.moveTo(positionX, positionY+i*yLabelDistance);
				main.graphics.lineTo(positionX + scaleX, positionY+i*yLabelDistance);
				main.graphics.moveTo(positionX, positionY-i*yLabelDistance);
				main.graphics.lineTo(positionX + scaleX, positionY-i*yLabelDistance);
			}
			
			main.graphics.endFill();
		}
		
	}

}