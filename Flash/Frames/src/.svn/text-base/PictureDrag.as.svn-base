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
	
	public class PictureDrag extends MovieClip
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var centerX:Number;
		public var centerY:Number;
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var string:String = new String();
		public var letter:String;
		public var framed:Boolean;
		public var isdragging:Boolean;
		public var selected:Boolean;		
		public var destinationX:Number;
		public var destinationY:Number;
		
		private var loaded:Boolean;
		private var finished:Boolean = false;
		
		public function PictureDrag(p_main:Main, p_x:Number, p_y:Number, s:String)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			sprite.addEventListener(MouseEvent.MOUSE_DOWN, onMouseClick);
			//sprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			main.stage.addEventListener(MouseEvent.MOUSE_UP, mouseUp);
			
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			
			loaded = false;
			myLoader.load(fileRequest);
			string = s;
			letter = string.charAt(string.length - 5);
			framed = false;
			
			sprite.addEventListener(MouseEvent.MOUSE_MOVE, move);
			sprite.addEventListener(MouseEvent.MOUSE_OVER, move);
			sprite.addEventListener(MouseEvent.MOUSE_OUT, out);
			out();
		
		}
		
		public function changePicture(s:String):void
		{
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			
			loaded = false;
			myLoader.load(fileRequest);
			string = s;
			letter = string.charAt(string.length - 5);
		}
		
		public function onLoaderReady(e:Event):void
		{
			loaded = true;
			sprite.addChild(myLoader);
			main.addChild(sprite);
			sprite.x = positionX;
			sprite.y = positionY;
			var a:Number = myLoader.width * 0.85;
			if (myLoader.height > a)
			{
				a = myLoader.height;
				sprite.scaleX = 145 / a;
				sprite.scaleY = 145 / a;
			}
			else
			{
				a = myLoader.width;
				sprite.scaleX = 171 / a;
				sprite.scaleY = 171 / a;
			}
			sprite.x = positionX - myLoader.width * sprite.scaleX / 2;
			sprite.y = positionY - myLoader.height * sprite.scaleY / 2;
			
			centerX = sprite.x + myLoader.width * sprite.scaleX / 2;
			centerY = sprite.y + myLoader.height * sprite.scaleY / 2;
			destinationX = positionX - myLoader.width * sprite.scaleX / 2;
			destinationY = positionY - myLoader.height * sprite.scaleY / 2;
			
			isdragging = false;
			selected = false;
			framed = false;
		}
		
		public function onMouseClick(e:Event):void
		{
			out();
			main.setOrder();
			main.changeString += "*" + letter;
			main.trackTime();
			sprite.startDrag();
			isdragging = true;
			main.setChildIndex(sprite, main.numChildren - 1);
			if (selected)
			{
				if (centerX > 640 && centerX < 850 && centerY > 47 && centerY < 257) //top
				{
					main.place1 = false;
					main.favOrder[0] = 0;
					var a:Number = myLoader.width * 0.85;
					if (myLoader.height > a)
					{
						a = myLoader.height;
						sprite.scaleX = 145 / a;
						sprite.scaleY = 145 / a;
					}
					else
					{
						a = myLoader.width;
						sprite.scaleX = 171 / a;
						sprite.scaleY = 171 / a;
					}
					
					sprite.x = mouseX - myLoader.width * sprite.scaleX / 2;
					sprite.y = mouseY - myLoader.height * sprite.scaleY / 2;
					framed = false;
				}
				if (centerX > 449 && centerX < 620 && centerY > 321 && centerY < 467) //bottom left
				{
					main.place2 = false;
					main.favOrder[1] = 0;
					framed = false;
				}
				if (centerX > 715 && centerX < 886 && centerY > 321 && centerY < 467) //bottom center
				{
					main.place3 = false;
					main.favOrder[2] = 0;
					framed = false;
				}
				if (centerX > 968 && centerX < 1139 && centerY > 321 && centerY < 467) //bottom right
				{
					main.place4 = false;
					main.favOrder[3] = 0;
					framed = false;
				}
			}
		}
		
		public function mouseUp(e:Event):void
		{
			if (isdragging)
			{
				onMouseUp();
			}
		}
		
		public function onMouseUp(e:Event = null):void
		{
			sprite.graphics.clear();
			sprite.stopDrag();
			isdragging = false;
			centerX = sprite.x + myLoader.width * sprite.scaleX / 2;
			centerY = sprite.y + myLoader.height * sprite.scaleY / 2;
			destinationX = positionX - myLoader.width * sprite.scaleX / 2;
			destinationY = positionY - myLoader.height * sprite.scaleY / 2;
			selected = false;
			if (main.place1 == false && centerX > 640 && centerX < 850 && centerY > 47 && centerY < 257) //top
			{
				var a:Number = myLoader.width * 0.85;
				sprite.scaleX = 1;
				sprite.scaleY = 1;
				if (myLoader.height > a)
				{
					a = myLoader.height;
					//trace ("1");
					sprite.scaleX = 210 / a;
					sprite.scaleY = 210 / a;
				}
				else
				{
					a = myLoader.width;
					//trace ("2");
					sprite.scaleX = 300 / a;
					sprite.scaleY = 300 / a;
				}
				destinationX = 790.7 - myLoader.width * sprite.scaleX / 2;
				destinationY = 152.5 - myLoader.height * sprite.scaleY / 2;
				main.place1 = true;
				selected = true;
				main.favOrder[0] = letter;
				framed = true;
			}
			if (main.place2 == false && centerX > 449 && centerX < 620 && centerY > 321 && centerY < 467)
			{
				destinationX = 534 - myLoader.width * sprite.scaleX / 2;
				destinationY = 395 - myLoader.height * sprite.scaleY / 2;
				main.place2 = true;
				selected = true;
				main.favOrder[1] = letter;
				framed = true;
			}
			if (main.place3 == false && centerX > 715 && centerX < 886 && centerY > 321 && centerY < 467)
			{
				destinationX = 800 - myLoader.width * sprite.scaleX / 2;
				destinationY = 395 - myLoader.height * sprite.scaleY / 2;
				main.place3 = true;
				selected = true;
				main.favOrder[2] = letter;
				framed = true;
			}
			if (main.place4 == false && centerX > 968 && centerX < 1139 && centerY > 321 && centerY < 467)
			{
				destinationX = 1053 - myLoader.width * sprite.scaleX / 2;
				destinationY = 395 - myLoader.height * sprite.scaleY / 2;
				main.place4 = true;
				selected = true;
				main.favOrder[3] = letter;
				framed = true;
			}
			if (main.trashAvailable && centerX > 1400 && centerX < 1500 && centerY > 520 && centerY < 790)
			{
				graphics.beginFill(0xFF0000);
				graphics.drawRect(1400, 520, 100, 270);
				//trace ("trashed");
				main.favOrder[4] = letter;
				compare();
				finished = true;
				main.displayNext();
			}
			if (main.favOrder[4] == 0 && !finished)
			{
				compare();
			}
		}
		
		private function compare():void
		{
			main.changeString += "^" + letter;
			if (main.compareOrder())
			{
				trace("Same order");
				main.trackTime();
			}
			else
			{
				trace("Different order");
				main.trackChange();
			}
		}
		
		public function move(e:Event = null):void
		{
			if (isdragging)
			{
				return;
			}
			if (framed)
			{
				
				sprite.graphics.beginFill(0x000000);
				sprite.graphics.drawRect(myLoader.x - 5, myLoader.y - 5, myLoader.width + 10, myLoader.height + 10);
				sprite.graphics.endFill();
				
			}
			else
			{
				
				var a:Number = myLoader.width * 0.85;
				if (myLoader.height > a)
				{
					a = myLoader.height;
					sprite.scaleX = 145 / a * 1.25;
					sprite.scaleY = 145 / a * 1.25;
				}
				else
				{
					a = myLoader.width;
					sprite.scaleX = 171 / a * 1.25;
					sprite.scaleY = 171 / a * 1.25;
				}
				sprite.x = positionX - myLoader.width * sprite.scaleX / 2;
				sprite.y = positionY - myLoader.height * sprite.scaleY / 2;
				destinationX = positionX - myLoader.width * sprite.scaleX / 2;
				destinationY = positionY - myLoader.height * sprite.scaleY / 2;
			}
		}
		
		public function out(e:Event = null):void
		{
			if (isdragging)
			{
				return;
			}
			sprite.alpha = 1;
			if (framed)
			{
				sprite.graphics.clear();
				return;
			}
			var a:Number = myLoader.width * 0.85;
			if (myLoader.height > a)
			{
				a = myLoader.height;
				sprite.scaleX = 145 / a;
				sprite.scaleY = 145 / a;
			}
			else
			{
				a = myLoader.width;
				sprite.scaleX = 171 / a;
				sprite.scaleY = 171 / a;
			}
			sprite.x = positionX - myLoader.width * sprite.scaleX / 2;
			sprite.y = positionY - myLoader.height * sprite.scaleY / 2;
			destinationX = positionX - myLoader.width * sprite.scaleX / 2;
			destinationY = positionY - myLoader.height * sprite.scaleY / 2;
		}
		
		public function remove():void
		{
			if (main.contains(sprite))
				main.removeChild(sprite);
		}
		
		public function update():void
		{
			if (!framed)
			{
				sprite.graphics.clear();
			}
			if (!framed && loaded)
			{
				sprite.graphics.beginFill(0x000000);
				sprite.graphics.drawRect(myLoader.x - 5, myLoader.y - 5, myLoader.width + 10, myLoader.height + 10);
				sprite.graphics.endFill();
			}
			
			if (!isdragging)
			{
				sprite.x = (sprite.x + destinationX) / 2;
				sprite.y = (sprite.y + destinationY) / 2;
			}
			else
			{
				
				sprite.x = main.mouseX - myLoader.width * sprite.scaleX / 2;
				sprite.y = main.mouseY - myLoader.height * sprite.scaleY / 2;
			}
			
			sprite.graphics.beginFill(0xFFFFFF);
			sprite.graphics.drawRect(myLoader.x, myLoader.y, myLoader.width, myLoader.height);
			sprite.graphics.endFill();
		
		}
	}
}