package  
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
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
		
		
		public function Picture(p_main:Main,p_x:Number,p_y:Number,s:String,p_length:Number) 
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			myLoader.load(fileRequest);
			string = s;
			length = p_length;
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
			sprite.scaleX = 1 / a * length;
			sprite.scaleY = 1 / a * length;
			sprite.x = positionX - myLoader.width / 2* sprite.scaleX;
			sprite.y = positionY - myLoader.height / 2 * sprite.scaleY;
			main.nextButton.add();
		} 
		
		public function loadNew(s:String):void
		{
			sprite.removeChild(myLoader);
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			myLoader.load(fileRequest);
			string = s;
		}
		
		public function resize(width:Number):void
		{
			length = width;
			sprite.scaleX = 1;
			sprite.scaleY = 1;
			var a:Number = myLoader.width;
			
			myLoader.scaleX = 1;
			myLoader.scaleY = 1;
			if (myLoader.height > a)
			{
				a = myLoader.height;
			}
			sprite.scaleX = width / a;
			sprite.scaleY = width / a;
			sprite.x = positionX - myLoader.width / 2 * sprite.scaleX;
			sprite.y = positionY - myLoader.height / 2 * sprite.scaleY;
			//sprite.x = positionX - myLoader.width  * sprite.scaleX / 2;
			//sprite.y = positionY - myLoader.height  * sprite.scaleY/ 2;
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
			sprite.x = positionX - myLoader.width / 2 * sprite.scaleX;
			sprite.y = positionY - myLoader.height / 2 * sprite.scaleX;
		}
	}

}