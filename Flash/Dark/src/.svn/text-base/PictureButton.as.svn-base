package  
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	
	public class PictureButton extends MovieClip 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var string:String = new String();
		public var scale:Number;
		public var isSelected:Boolean;
		private var size:Number;
		
		public function PictureButton(p_main:Main,p_x:Number,p_y:Number,si:Number,s:String) 
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			myLoader.load(new URLRequest(main.prefix + s));
			string = s;
			size = si;
			isSelected = false;
		}
		
		public function onLoaderReady(e:Event) :void
		{     
			sprite.addChild(myLoader);
			main.addChild(sprite);
			sprite.x = positionX;
			sprite.y = positionY;
			var a:Number = myLoader.width;
			if (myLoader.height > a)
			{
				a = myLoader.height;
				sprite.scaleX = size / a;
				sprite.scaleY = size / a;
			}
			else
			{
				a = myLoader.width;
				sprite.scaleX = size / a;
				sprite.scaleY = size / a;
			}
			sprite.x = positionX - myLoader.width  * sprite.scaleX / 2;
			sprite.y = positionY - myLoader.height  * sprite.scaleY / 2;
			//trace(sprite.x);
		} 
		
		public function remove():void
		{
			main.removeChild(sprite);
		}
	}

}