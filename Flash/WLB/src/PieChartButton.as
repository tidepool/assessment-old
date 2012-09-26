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
	
	public class PieChartButton
	{
		public var main:Main;
		public var chart:PieChart;
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
		public var lastRad:Number;
		public var lastX:Number;
		public var lastY:Number;
		public var index:int;
		public var last:uint;
		public var changes:String;
		private var alphaInc:Boolean = false;
		
		private var ticks:uint = 0;
		
		public function PieChartButton(p_main:Main, p_chart:PieChart, p_rad:Number, p_index:int)
		{
			index = p_index;
			chart = p_chart;
			main = p_main;
			r = chart.r;
			rad = p_rad;
			
			originalX = chart.positionX;
			originalY = chart.positionY;
			
			positionX = originalX + r * Math.cos(rad);
			positionY = originalY + r * Math.sin(rad);
			
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + "assets/button.png");
			myLoader.load(fileRequest);
			
			fileRequest = new URLRequest(main.prefix + "assets/mask.png");
			
			maskLoader.load(fileRequest);
			isDragging = false;
			changes = "";
		}
		
		public function onLoaderReady(e:Event):void
		{
			sprite.addChild(myLoader);
			main.addChild(sprite);
			sprite.x = positionX - myLoader.width / 2;
			sprite.y = positionY - myLoader.height / 2;
			
			maskSprite.addChild(maskLoader);
			main.addChild(maskSprite);
			maskSprite.x = sprite.x;
			maskSprite.y = sprite.y;
			main.setChildIndex(maskSprite, main.numChildren - 1);
			
			maskSprite.addEventListener(MouseEvent.MOUSE_DOWN, onMouseClick);
			maskSprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			maskSprite.addEventListener(MouseEvent.MOUSE_MOVE, onMouseMove);
		}
		
		public function onMouseMove(e:Event):void
		{
			if (isDragging)
			{
				chart.redraw();
			}
		}
		
		public function onMouseClick(e:Event):void
		{
			maskSprite.startDrag();
			isDragging = true;
			main.setChildIndex(maskSprite, main.numChildren - 1);
		}
		
		public function onMouseUp(e:Event):void
		{
			changes += "*" + chart.percentage[1] + "@" + main.getTime();
			trace(changes);
			maskSprite.stopDrag();
			isDragging = false;
			//update();
		}
		
		public function update():void
		{
			var temp:Number = myLoader.width * myLoader.scaleX / 2;
			if (isDragging)
			{
				var distance:Number = Math.sqrt((maskSprite.x + 10 - originalX) * (maskSprite.x + 10 - originalX) + (maskSprite.y + 10 - originalY) * (maskSprite.y + 10 - originalY));
				sprite.x = originalX + (maskSprite.x + 10 - originalX) / distance * r - 10;
				sprite.y = originalY + (maskSprite.y + 10 - originalY) / distance * r - 10;
				calculateRad();
				correct();
			}
			else
			{
				maskSprite.x = sprite.x;
				maskSprite.y = sprite.y;
			}
			updateAlpha();
		}
		
		private function updateAlpha():void
		{
			if (!isDragging)
			{
				var increaser:Number = 0.01;
				if (myLoader.scaleX > 1.2)
				{
					alphaInc = false;
				}
				else if (myLoader.scaleX < 0.9)
				{
					alphaInc = true;
				}
				if (alphaInc)
				{
					myLoader.scaleX += increaser;
					myLoader.scaleY += increaser;
					sprite.x = positionX - myLoader.width / 2;
					sprite.y = positionY - myLoader.height / 2;
				}
				else
				{
					myLoader.scaleX -= increaser;
					myLoader.scaleY -= increaser;
					sprite.x = positionX - myLoader.width / 2;
					sprite.y = positionY - myLoader.height / 2;
				}
			}
		}
		
		public function correct():void
		{
			if (chart.length == 2)
			{
				if (lastRad > 5 && rad < 1)
				{
					sprite.x = lastX;
					sprite.y = lastY;
					rad = lastRad;
				}
				if (lastRad < 1 && rad > 5)
				{
					sprite.x = lastX;
					sprite.y = lastY;
					rad = lastRad;
				}
				lastRad = rad;
				lastX = sprite.x;
				lastY = sprite.y;
				return;
			}
			if (index != chart.length - 2 && index != 0)
			{
				
				if (rad > chart.buttons[index + 1].rad)
				{
					sprite.x = chart.buttons[index + 1].sprite.x;
					sprite.y = chart.buttons[index + 1].sprite.y;
				}
				
				if (rad < chart.buttons[index - 1].rad)
				{
					sprite.x = chart.buttons[index - 1].sprite.x;
					sprite.y = chart.buttons[index - 1].sprite.y;
					rad = chart.buttons[index - 1].rad;
				}
			}
			if (index == 0)
			{
				if (rad > chart.buttons[index + 1].rad)
				{
					sprite.x = chart.buttons[index + 1].sprite.x;
					sprite.y = chart.buttons[index + 1].sprite.y;
				}
				if (rad > chart.buttons[index + 2].rad)
				{
					sprite.x = originalX + r - 10;
					sprite.y = originalY - 10;
					rad = 0;
				}
			}
			if (index == chart.length)
			{
				if (rad < chart.buttons[index - 2].rad)
				{
					sprite.x = originalX + r - 10;
					sprite.y = originalY - 10;
					rad = Math.PI * 2;
					return;
				}
				if (rad < chart.buttons[index - 1].rad)
				{
					sprite.x = chart.buttons[index - 1].sprite.x;
					sprite.y = chart.buttons[index - 1].sprite.y;
					rad = chart.buttons[index - 1].rad;
				}
				
			}
		}
		
		public function calculateRad():void
		{
			positionX = sprite.x + 10;
			positionY = sprite.y + 10;
			if (positionY - originalY == 0)
			{
				if (positionX - originalX > 0)
				{
					rad = Math.PI * 2;
				}
				else
				{
					rad = Math.PI;
				}
			}
			else
			{
				
				if ((positionY - originalY) < 0)
				{
					rad = Math.acos((positionX - originalX) / r);
				}
				else
				{
					rad = Math.PI * 2 - Math.acos((positionX - originalX) / r);
				}
			}
			rad = Math.PI * 2 - rad;
		
		}
	}

}