package  
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	import flash.utils.getTimer;
	/**
	 * ...
	 * @author wei
	 */
	public class piechartButton extends MovieClip 
	{
		public var main:Main;
		public var chart:piechart;
		
		public var positionX:Number;
		public var positionY:Number;
		
		public var originalX:Number;
		public var originalY:Number;
		
		public var isDragging:Boolean;
		
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		
		public var maskLoader:Loader = new Loader();
		public var maskSprite:Sprite = new Sprite();
		
		public var r:Number;
		public var rad:Number;
		
		public var index:int;
		
		public var last:uint;
		private var ticks:uint = 0;

		
		public function piechartButton(p_main:Main,p_chart:piechart,p_rad:Number,p_index:int) 
		{
			index = p_index;
			chart = p_chart;
			main = p_main;
			r = chart.r;
			rad = p_rad;
			
			originalX = chart.positionX;
			originalY = chart.positionY;
			
			positionX = originalX+r * Math.cos(rad);
			positionY = originalY+r * Math.sin(rad);
			
			
			
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest("assets/DimensionCharts/button.png");
		//	myLoader.load(fileRequest);
			
			fileRequest = new URLRequest("assets/DimensionCharts/mask.png");
			
			maskLoader.load(fileRequest);
			isDragging = false;
			
		}
		
		public function onLoaderReady(e:Event) :void
		{     
			// the image is now loaded, so let's add it to the display tree!     
			sprite.addChild(myLoader);
			main.addChild(sprite);
			sprite.x = positionX-10;
			sprite.y = positionY-10;
			
			maskSprite.addChild(maskLoader);
			main.addChild(maskSprite);
			maskSprite.x = sprite.x;
			maskSprite.y = sprite.y;
			
			
		//	maskSprite.addEventListener(MouseEvent.MOUSE_DOWN, onMouseClick);
		//	maskSprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
		//	maskSprite.addEventListener(MouseEvent.MOUSE_MOVE, onMouseMove);
		} 
		
		public function onMouseMove(e:Event):void
		{
			if (isDragging)
			{
				chart.redraw();
			}
		}
		
		
		public function onMouseClick(e:Event) :void
		{
			maskSprite.startDrag();
			isDragging = true;
		}
		
		public function onMouseUp(e:Event) :void
		{
			maskSprite.stopDrag();
			isDragging = false;
			update();
		}
		
		
		public function update():void
		{
 
			
			if (isDragging)
			{
				var distance:Number =Math.sqrt( (maskSprite.x+10-originalX) * (maskSprite.x+10-originalX) + (maskSprite.y+10-originalY) * (maskSprite.y+10-originalY));
				sprite.x = originalX + (maskSprite.x+10 - originalX) / distance * r-10;
				sprite.y = originalY + (maskSprite.y+10 - originalY) / distance * r-10;
				
				calculateRad();
				correct();
			}
			else
			{
				maskSprite.x = sprite.x;
				maskSprite.y = sprite.y;
			}
			
			
		}
		
		public function correct():void
		{
			if (index !=chart.length-2&&index!=0)
			{
				
				if (rad > chart.pictures[index + 1].rad)
				{
					sprite.x = chart.pictures[index + 1].sprite.x;
					sprite.y = chart.pictures[index + 1].sprite.y;
					rad = chart.pictures[index +1].rad;
				}

				if (rad < chart.pictures[index -1].rad)
				{
					sprite.x = chart.pictures[index -1].sprite.x;
					sprite.y = chart.pictures[index -1].sprite.y;
					rad = chart.pictures[index -1].rad;
				}
			}
		
			if (index == 0)
			{
				if (rad > chart.pictures[index + 2].rad)
				{
					sprite.x = originalX+r-10;
					sprite.y = originalY-10;
					rad = 0;
					return;
				}
				if (rad > chart.pictures[index + 1].rad)
				{
					sprite.x = chart.pictures[index + 1].sprite.x;
					sprite.y = chart.pictures[index + 1].sprite.y;
					rad = chart.pictures[index +1].rad;
				}
			}
			if (index ==chart.length-2)
			{
				if (rad < chart.pictures[index -2].rad)
				{
					sprite.x = originalX+r-10;
					sprite.y = originalY-10;
					rad = Math.PI * 2;
					return;
				}
				if (rad < chart.pictures[index -1].rad)
				{
					sprite.x = chart.pictures[index -1].sprite.x;
					sprite.y = chart.pictures[index -1].sprite.y;
					rad = chart.pictures[index -1].rad;
				}
				
			}
			
		}
		
		public function calculateRad():void
		{
			positionX = sprite.x+10;
			positionY = sprite.y+10;
			if (positionY - originalY == 0)
			{
				if (positionX - originalX > 0)
				{
					rad=Math.PI*2;
				}
				else
				{
					rad=Math.PI;
				}
			}
			else
			{
				
				if ((positionY - originalY) < 0)
				{
					rad=Math.acos((positionX - originalX)/r  );
				}
				else
				{
					rad=Math.PI*2-Math.acos((positionX - originalX)/ r);
				}
			}
			rad = Math.PI * 2 - rad;
			
		}
	}

}