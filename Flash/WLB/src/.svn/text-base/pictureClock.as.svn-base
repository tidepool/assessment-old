package  
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	
	public class pictureClock extends MovieClip 
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
		public var chart:PieChart;
		
		
		public function pictureClock(p_main:Main,p_x:Number,p_y:Number,s:String,p_length:Number,p_chart:PieChart=null) 
		{
			main = p_main;
			chart = p_chart;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			myLoader.load(fileRequest);
			
			fileRequest = new URLRequest(main.prefix + "assets/Clock/mask.png");
			maskLoader.load(fileRequest);
			string = s;
			length = p_length;
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
			myLoader.scaleX = 1 / a * length;
			myLoader.scaleY = 1 / a * length;
			maskLoader.scaleX = myLoader.scaleX;
			maskLoader.scaleY = myLoader.scaleY;
			var scale:Number = 1 / a * length;
			sprite.x = positionX - myLoader.width / 2*sprite.scaleX;
			sprite.y = positionY - myLoader.height / 2 * sprite.scaleX;
			if (chart != null)
			{
				chart.redraw();
			}
		} 
		
		public function update():void
		{
			var a:Number = myLoader.width;
			if (myLoader.height > a)
			{
				a = myLoader.height;
			}
		//	myLoader.scaleX = 1 / a * length;
		//	myLoader.scaleY = 1 / a * length;
			sprite.scaleX = 1 / a * length;
			sprite.scaleY = 1 / a * length;
			sprite.x = positionX - myLoader.width / 2*sprite.scaleX;
			sprite.y = positionY - myLoader.height / 2 * sprite.scaleX;
			
			if (main.contains(masksprite))
			{
				main.setChildIndex(masksprite,1);
			}
			if (main.contains(sprite))
			{
				main.setChildIndex(sprite,0);
			}
			masksprite.x = sprite.x;
			masksprite.y = sprite.y;
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
	}

}