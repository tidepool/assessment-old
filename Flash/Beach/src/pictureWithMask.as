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
	
	public class pictureWithMask extends MovieClip 
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
		
		public var isLoaded:Boolean = false;
		public var defaultIndex:int;
		
		
		public function pictureWithMask(p_main:Main,p_x:Number,p_y:Number,s:String,p_length:Number,p_defaultIndex:int=10) 
		{
			main = p_main;
			defaultIndex = p_defaultIndex;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			maskLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			myLoader.load(fileRequest);
			fileRequest = new URLRequest(main.prefix + "assets/mask.png");
			maskLoader.load(fileRequest);
			string = s;
			length = p_length;
			main.addEventListener(Event.ENTER_FRAME, update);
			
			masksprite.addEventListener(MouseEvent.CLICK, click);
			masksprite.addEventListener(MouseEvent.MOUSE_MOVE, move);
			masksprite.addEventListener(MouseEvent.MOUSE_OUT, out);
		}
		
		public function onLoaderReady(e:Event) :void
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
			sprite.scaleX = 1 / a * length;
			sprite.scaleY = 1 / a * length;
			var scale:Number = 1 / a * length;
			sprite.x = positionX - myLoader.width / 2 * sprite.scaleX;
			sprite.y = positionY - myLoader.height / 2 * sprite.scaleY;
			
			masksprite.scaleX = 1 / maskLoader.width * myLoader.width * sprite.scaleX;
			masksprite.scaleY = 1 / maskLoader.height * myLoader.height * sprite.scaleY;
			
			
			masksprite.x = positionX - maskLoader.width / 2 * masksprite.scaleX;
			masksprite.y = positionY - maskLoader.height / 2 * masksprite.scaleY;
			

			if (main.contains(sprite))
			{
				if (defaultIndex > 5)
				{
					main.setChildIndex(sprite, main.numChildren - 1);
				}
				else
				{
					main.setChildIndex(sprite, 0);
				}
			}
			if (main.contains(masksprite))
			{
				main.setChildIndex(masksprite,main.numChildren-1);
			}
			
			isLoaded = true;
		} 
		
		public function update(e:Event):void
		{
			if (main.contains(masksprite))
			{
				main.setChildIndex(masksprite, main.numChildren - 1);
			}
		}
		
		public function loadNew(s:String):void
		{
			if(sprite.contains(myLoader))
			sprite.removeChild(myLoader);
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
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
			if (main.contains(masksprite))
			{
				main.removeChild(masksprite);
			}
		}
		
		
		public function click(e:MouseEvent=null):void
		{
		//	trace("ergewg");
			new picture(main,500,500,"assets/chicken.jpg",300);
		}
		
		public function move(e:MouseEvent=null):void
		{
		}
		
		public function out(e:MouseEvent=null):void
		{
		}
	}

}