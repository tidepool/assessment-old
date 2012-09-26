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
	
	public class PictureWithFade
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var myLoader:Loader
		public var string:String = new String();
		public var time:Number;
		public var sprite:Sprite;
		public var isGrouped:Boolean;
		private var color:uint;
		private var isLoaded:Boolean;
		
		public function PictureWithFade(p_main:Main, p_x:Number, p_y:Number)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			myLoader = new Loader();
			sprite = new Sprite();
			main.addChild(sprite);
			sprite.addChild(myLoader);
			myLoader.addEventListener(MouseEvent.CLICK, clicked);
			color = 0xFFFFFF;
		}
		
		public function update():void
		{
			if (isLoaded)
			{
				sprite.graphics.clear();
				sprite.graphics.beginFill(color, 0.05);
				sprite.graphics.drawRect(myLoader.x - 10, myLoader.y - 10, myLoader.width + 20, myLoader.height + 20);
				sprite.graphics.endFill();
				sprite.graphics.beginFill(color, 0.1);
				sprite.graphics.drawRect(myLoader.x - 9, myLoader.y - 9, myLoader.width + 18, myLoader.height + 18);
				sprite.graphics.endFill();
				sprite.graphics.beginFill(color, 0.15);
				sprite.graphics.drawRect(myLoader.x - 8, myLoader.y - 8, myLoader.width + 16, myLoader.height + 16);
				sprite.graphics.endFill();
				sprite.graphics.beginFill(color, 0.2);
				sprite.graphics.drawRect(myLoader.x - 7, myLoader.y - 7, myLoader.width + 14, myLoader.height + 14);
				sprite.graphics.endFill();
				sprite.graphics.beginFill(color, 0.25);
				sprite.graphics.drawRect(myLoader.x - 6, myLoader.y - 6, myLoader.width + 12, myLoader.height + 12);
				sprite.graphics.endFill();
				sprite.graphics.beginFill(color, 0.3);
				sprite.graphics.drawRect(myLoader.x - 5, myLoader.y - 5, myLoader.width + 10, myLoader.height + 10);
				sprite.graphics.endFill();
				sprite.graphics.beginFill(color, 0.35);
				sprite.graphics.drawRect(myLoader.x - 4, myLoader.y - 4, myLoader.width + 8, myLoader.height + 8);
				sprite.graphics.endFill();
				sprite.graphics.beginFill(color, 0.4);
				sprite.graphics.drawRect(myLoader.x - 3, myLoader.y - 3, myLoader.width + 6, myLoader.height + 6);
				sprite.graphics.endFill();
				sprite.graphics.beginFill(color, 0.45);
				sprite.graphics.drawRect(myLoader.x - 2, myLoader.y - 2, myLoader.width + 4, myLoader.height + 4);
				sprite.graphics.beginFill(color, 0.5);
				sprite.graphics.drawRect(myLoader.x - 1, myLoader.y - 1, myLoader.width + 2, myLoader.height + 2);
				sprite.graphics.endFill();
			}
		}
		
		private function onLoaderReady(e:Event):void
		{
			if (!isGrouped)
			{
				myLoader.scaleX = 1;
				myLoader.scaleY = 1;
			}
			else
			{
				myLoader.scaleX = 0.6;
				myLoader.scaleY = 0.6;
			}
			
			myLoader.y = positionY - (myLoader.height * myLoader.scaleY / 2);
			myLoader.x = positionX - (myLoader.width * myLoader.scaleX / 2);
			
			sprite.addEventListener(MouseEvent.MOUSE_MOVE, move);
			sprite.addEventListener(MouseEvent.MOUSE_OUT, out);
			sprite.addEventListener(MouseEvent.MOUSE_OVER, move);
			sprite.addChild(myLoader);
			isLoaded = true;
			out();
		}
		
		public function loadNew(s:String, group:Boolean = false):void
		{
			isLoaded = false;
			isGrouped = group;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			myLoader.load(new URLRequest(main.prefix + s));
			string = s;
		}
		
		public function clicked(e:Event):void
		{
			time = getTimer() - main.elapsedTime + (main.cycleList[main.index - 1] * 5000);
			
			main.xmlString += "<set>";
			var temp:String = string.substring(7, string.length - 4);
			main.xmlString += "<sel>" + temp + "</sel>";
			main.xmlString += "<ti>" + time + "</ti>";
			main.xmlString += "</set>";
			main.chosenPics[chooseChosen(temp)].push(new PictureData(string, time));
			main.displayNext(true);
		}
		
		public function chooseChosen(str:String):int
		{
			var num:int = int(str.substring(1));
			trace(num);
			if (num <= 8)
			{
				return 0;
			}
			else if (num <= 16)
			{
				return 1;
			}
			else if (num <= 24)
			{
				return 2;
			}
			else
			{
				return -1;
			}
		}
		
		public function clear():void
		{
			sprite.graphics.clear();
			sprite.removeChild(myLoader);
			main.removeChild(sprite);
		}
		
		public function move(e:Event = null):void
		{
			sprite.alpha = 1;
			color = 0x0000ff
		}
		
		public function out(e:Event = null):void
		{
			sprite.alpha = 1;
			color = 0xFFFFFF
		}
	}

}