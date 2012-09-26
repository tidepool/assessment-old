package  
{
	import flash.display.Bitmap;
	import flash.display.BitmapData;
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.geom.Rectangle;
	import flash.net.URLRequest;
	
	public class pictureButton1 extends MovieClip 
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
		public var bmd:BitmapData;
		public var shouldBM:Boolean;
		public var areaName:String;
		public var count:int = 0;
		public function pictureButton1(p_main:Main,p_x:Number,p_y:Number,s:String,p_name:String="",p_scale:Number=1,p_shouldAdd:Boolean=true,p_BM:Boolean=false) 
		{
			main = p_main;
			areaName = p_name;
			shouldAdd = p_shouldAdd;
			shouldBM = p_BM;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest( s);
			scale = p_scale;
			myLoader.load(fileRequest);
			string =main.prefix+ s;
			isSelected = false;
		}
		
		public function onLoaderReady(e:Event) :void
		{     
			sprite.addChild(myLoader);
			if (shouldAdd )
			{
				main.addChild(sprite);
			}
			sprite.x = positionX;
			sprite.y = positionY;
			sprite.scaleX = scale;
			sprite.scaleY = scale;
	
			if (shouldBM)
			{
				var rect:Rectangle = new Rectangle(0,0,900,480);
				bmd = new BitmapData(rect.width, rect.height, true, 0);
				bmd.draw(myLoader.content);
				main.setChildIndex(sprite,0);
			}
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
			string =main.prefix+ s;
			
		}
	}

}