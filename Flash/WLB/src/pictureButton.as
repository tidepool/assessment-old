package  
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	
	public class pictureButton extends MovieClip 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var string:String = new String();
		public var scale:Number;
		public var isSelected:Boolean;
		public var shouldAdd:Boolean;
		public function pictureButton(p_main:Main,p_x:Number,p_y:Number,s:String,p_scale:Number=1,p_shouldAdd:Boolean=true) 
		{
			main = p_main;
			shouldAdd = p_shouldAdd;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			scale = p_scale;
			myLoader.load(fileRequest);
			string = s;
			isSelected = false;
		}
		
		public function onLoaderReady(e:Event) :void
		{     
			sprite.addChild(myLoader);
			if (shouldAdd)
			{
				main.addChild(sprite);
			}
			
			sprite.scaleX = scale;
			sprite.scaleY = scale;
			sprite.x = positionX - myLoader.width * sprite.scaleX / 2;
			sprite.y = positionY;
		} 
		
		
		public function remove():void
		{
			main.removeChild(sprite);
		}
		
		public function loadNew(s:String):void
		{
			shouldAdd = true;
			if(sprite.contains(myLoader))
			sprite.removeChild(myLoader);
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			myLoader.load(fileRequest);
			string = s;
			
		}
	}

}