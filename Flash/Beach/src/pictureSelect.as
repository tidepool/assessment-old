package
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	
	public class pictureSelect extends MovieClip
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var string:String = new String();
		public var length:Number;
		public var maskLoader:Loader = new Loader();
		public var masksprite:Sprite = new Sprite();
		public var dx:Number;
		public var dy:Number;
		public var l:Label;
		public var t:String;
		public var selected:Boolean = false;
		public var screen:Select3;
		public var xmlData:String;
		
		private var index:int;
		
		public function pictureSelect(p_main:Main, p_x:Number, p_y:Number, s:String, p_label:String, p_length:Number, p_data:String = "select", p_sc:Select3 = null)
		{
			main = p_main;
			screen = p_sc;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			myLoader.load(fileRequest);
			string = s;
			length = p_length;
			t = p_label;
			xmlData = p_data;
			index = int(p_data.substr(p_data.length - 1, 1));
		}
		
		public function onLoaderReady(e:Event):void
		{
			sprite.addChild(myLoader);
			
			main.addChild(sprite);
			masksprite.addChild(maskLoader);
			main.addChild(masksprite);
			
			var a:Number = myLoader.width;
			if (myLoader.height > a)
			{
				a = myLoader.height;
			}
			myLoader.scaleX = 1 / a * length;
			myLoader.scaleY = 1 / a * length;
			var scale:Number = 1 / a * length;
			sprite.x = positionX - myLoader.width / 2 * sprite.scaleX;
			sprite.y = positionY - myLoader.height / 2 * sprite.scaleX;
			
			dx = sprite.x;
			dy = sprite.y;
			
			sprite.addEventListener(MouseEvent.CLICK, click);
			sprite.addEventListener(MouseEvent.MOUSE_MOVE, move);
			sprite.addEventListener(MouseEvent.MOUSE_OUT, out);
			l = new Label(main, positionX, positionY + myLoader.height / 2 * sprite.scaleY + 50, t, 20, 400, true);
		}
		
		public function update():void
		{
			var a:Number = myLoader.width;
			if (myLoader.height > a)
			{
				a = myLoader.height;
			}
			sprite.x = (sprite.x + dx) / 2;
			sprite.y = (sprite.y + dy) / 2;
			if (sprite.alpha < 0.2)
			{
				if (main.contains(sprite))
				{
					main.removeChild(sprite);
					l.changeText(0, 0, 1, "");
				}
			}
			if (selected)
			{
				sprite.alpha -= 0.05;
			}
		}
		
		public function loadNew(s:String):void
		{
			sprite.removeChild(myLoader);
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			myLoader.load(fileRequest);
			string = s;
			length = 400;
		
		}
		
		public function calculateDes():void
		{
			dx = 800 - myLoader.width / 2 * sprite.scaleX;
			dy = 600 - myLoader.height / 2 * sprite.scaleY;
		}
		
		public function click(e:Event):void
		{
			calculateDes();
			if (screen != null)
			{
				screen.click(index);
			}
			selected = true;
		}
		
		public function move(e:Event):void
		{
			l.text.textColor = 0x8746FF;
		}
		
		public function out(e:Event):void
		{
			l.text.textColor = 0;
		}
	}

}