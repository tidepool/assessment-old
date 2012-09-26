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
		public var letter:String;
		
		public function PictureButton(p_main:Main,p_x:Number,p_y:Number,s:String) 
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			//myLoader.addEventListener(MouseEvent.CLICK, onMouseClick);
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			myLoader.load(fileRequest);
			string = s;
			letter = string.charAt(string.length - 5);
			
			//sprite.addEventListener(MouseEvent.MOUSE_MOVE, move);
			//sprite.addEventListener(MouseEvent.MOUSE_OUT, out);
			out();
		}
		
		public function changePicture(s:String):void
		{
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			myLoader.load(fileRequest);
			string = s;			
			letter = string.charAt(string.length - 5);
		}
		
		public function onLoaderReady(e:Event) :void
		{         
			sprite.addChild(myLoader);
			main.addChild(sprite);
			sprite.x = positionX;
			sprite.y = positionY;
			
			var a:Number = myLoader.width * 0.71;
			if (myLoader.height > a)
			{
				a = myLoader.height;
				sprite.scaleX = 322 / a;
				sprite.scaleY = 322 / a;
			}
			else
			{
				a = myLoader.width;
				sprite.scaleX = 458 / a;
				sprite.scaleY = 458 / a;
			}
			sprite.x = positionX - myLoader.width  * sprite.scaleX / 2;
			sprite.y = positionY - myLoader.height  * sprite.scaleY / 2;
		} 		
		
		
		public function move(e:Event=null):void
		{
			//sprite.alpha = 0.85;
		}
		
		public function out(e:Event=null):void
		{
			//sprite.alpha = 1;
		}
		
		public function onMouseClick(e:Event) :void
		{
			if (main.disableClick)
			{
				return;
			}
			
			main.favOrder[0] = letter;
			main.displayNext();
		}
		
		public function remove():void
		{
			main.removeChild(sprite);
		}
	}

}