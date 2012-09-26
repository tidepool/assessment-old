package  
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.*;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.geom.Point;
	
	public class RadarGraph 
	{
		public var positionX:Number;
		public var positionY:Number;
		public var values:Array = new Array();
		public var scale:Number;
		public var main:Main;
		public var userData:Array = new Array();
		public var sprite:Sprite;
		public var lines:Array = new Array();	
		public var idealScore:Array;		
		public var otherScore:Array;	
		
		private var ticker:Number = 0;		
		private var mask:Loader;			
		private var isResizing:Boolean;
		private var originalY:Number;
		private var lastY:Number;
		private var vertices:int;		
		private var idealLabel:Label;
		private var otherLabel:Label;
		
		
		public function RadarGraph(p_main:Main, px:Number, py:Number, s:Number = 300, v:int = 5) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			scale = s/100;
			vertices = v;
			
			sprite = new Sprite();
			main.addChild(sprite);
			
			idealLabel = new Label(main, 1425, 275, "You", 25, 150, false, 0x003366);
			idealLabel.addBold();
			otherLabel = new Label(main, 1425, 310, "", 25, 150, false, 0x00CC00);
			otherLabel.addBold();
			addLines();
		}
	
		public function addLines():void
		{
			var names:Array = new Array("Conscientiousness", "Agreeableness", "Extroversion", "Emotional Stability", "Openness");	
			for (var i:int = 0; i < vertices; i++)
			{
				lines.push(new RadarLine(main, this, positionX, positionY, scale, (360 / vertices * i),  names[i], i));
			}
			drawVertices();
		}
		
		public function drawVertices():void
		{
			for (var i:int=0; i < lines.length; i++ )
			{			
				lines[i].drawDegree();
			}
		}
		
		public function drawIdeal():void
		{
			if (idealScore != null)
			{		
				for (var i:int=0; i < idealScore.length; i++ )
				{
					idealScore[i].drawLine(0x003366,idealScore);
					lines[i].drawDegree();
				}	
			}
		}
		
		public function drawPolygon():void
		{
			for (var i:int=0; i < otherScore.length; i++ )
			{
				otherScore[i].drawPolygon(otherScore);
			}
			/*
			for (i=0; i < otherScore.length; i++ )
			{
				otherScore[i].drawLine(0x008B45,otherScore);
				lines[i].drawDegree();
			}
			*/
			drawIdeal();
			drawVertices();
		}
		public function createData():void
		{
			
		}
		
		public function update():void
		{	
			
		}
		
		public function updateStats(data:Array,name:String):void
		{
			sprite.graphics.clear();	
			otherLabel.changeString(name);
			otherScore = new Array();
			for (var i:int = 0; i < vertices; i++)
			{
				otherScore.push(new RadarPolygon(main, this, positionX, positionY, scale, data[i], (360 / vertices * i), i));
			}
			drawPolygon();
			main.drawBorders();
		}	
		
		public function setIdeal(data:Array):void
		{
			sprite.graphics.clear();	
			idealScore = new Array();
			for (var i:int = 0; i < vertices; i++)
			{
				idealScore.push(new RadarPolygon(main, this, positionX, positionY, scale, data[i], (360 / vertices * i), i));
			}
			drawIdeal();
			main.drawBorders();
		}	
	}

}