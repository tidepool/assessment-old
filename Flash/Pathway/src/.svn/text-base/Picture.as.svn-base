package  
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.media.Video;
	import flash.net.URLRequest;
	
	public class Picture extends MovieClip 
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
		
		public var isLoaded:Boolean=false;
		
		public function Picture(p_main:Main,p_x:Number,p_y:Number,s:String,p_length:Number) 
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(s);
			myLoader.load(fileRequest);
			string = s;
			length = p_length;
			main.addEventListener(Event.ENTER_FRAME, update);
		}
		
		public function onLoaderReady(e:Event) :void
		{
			sprite.addChild(myLoader);
			
			main.addChild(sprite);
			
			
			var a:Number = myLoader.width;
			if (myLoader.height > a)
			{
				a = myLoader.height;
			}
			myLoader.scaleX = 1 / a * length;
			myLoader.scaleY = 1 / a * length;
			var scale:Number = 1 / a * length;
			sprite.x = positionX - myLoader.width / 2*sprite.scaleX;
			sprite.y = positionY - myLoader.height / 2 * sprite.scaleX;

			if (main.contains(sprite))
			{
				main.setChildIndex(sprite,main.numChildren-1);
			}
			
			isLoaded = true;
		} 
		
		public function update(e:Event):void
		{
			if (isLoaded)
			{
				positionX = sprite.x + myLoader.width / 2 * sprite.scaleX;
				positionY = sprite.y + myLoader.height / 2 * sprite.scaleY;
			}
		}
		
		public function loadNew(s:String):void
		{
			if(sprite.contains(myLoader))
			sprite.removeChild(myLoader);
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(s);
			myLoader.load(fileRequest);
			string = s;
		//	length = 400;
			
		}
		
		public function setLength(l:Number):void
		{
			length = l;
			var a:Number = myLoader.width;
			if (myLoader.height > a)
			{
				a = myLoader.height;
			}
			sprite.scaleX = 1 / a * length;
			sprite.scaleY = 1 / a * length;
			sprite.x = positionX - myLoader.width / 2*sprite.scaleX;
			sprite.y = positionY - myLoader.height / 2 * sprite.scaleX;
		}
		
		public function setPosition(px:Number, py:Number):void
		{
			positionX = px;
			positionY = py;
			sprite.x = positionX - myLoader.width / 2*sprite.scaleX;
			sprite.y = positionY - myLoader.height / 2 * sprite.scaleY;
		}
		
		public function remove():void
		{
			main.removeEventListener(Event.ENTER_FRAME, update);
			if (main.contains(sprite))
			{
				main.removeChild(sprite);
			}
		}
	}

}