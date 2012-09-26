package  
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	/**
	 * ...
	 * @author wei
	 */
	public class bar extends MovieClip 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var value:Number;
		public var text:label;
		public var barName:String;
		public var scale:Number = 0;
		public var barNameLabel:label;
		
		public var redrawTimer:int = 3;
		
		
		public function bar(p_main:Main,p_x:Number,p_y:Number,p_name:String)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			barName = p_name;
			main.addEventListener(Event.ENTER_FRAME, update);
		}
		
		public function onLoaderReady(e:Event) :void
		{
			sprite.addChild(myLoader);
			main.addChild(sprite);
			
			sprite.scaleY = 0.4;
			sprite.x = positionX ;
			sprite.y = positionY ;
			text = new label(main, positionX, positionY + 7, int(value * 100) + "");
			barNameLabel=new label(main, positionX - 170, positionY + 7, barName);
			sprite.scaleX = 0;
		}
		
		public function drawBar(p_value:Number,p_max:Number):void
		{
			var fileRequest:URLRequest = new URLRequest("assets/DimensionCharts/bar.png");
			myLoader.load(fileRequest);
			value = p_value;
			
			scale = value * 100 / p_max;
		}
		
		public function update(e:Event=null):void
		{
			if (main.contains(sprite))
			{
				redrawTimer--;
				if (redrawTimer < 0)
				{
					redrawTimer = 3;
					sprite.scaleX = sprite.scaleX + (scale-sprite.scaleX) / 20;
					var px:Number = positionX + myLoader.width * sprite.scaleX / 2 ;
				
					text.changeText(px, positionY + 16, 25, (int)(value * 100 * sprite.scaleX / scale) + "");
				}
				
				if (sprite.scaleX > scale * 0.98)
				{
					sprite.scaleX = scale;
				}
			}
		}
		
		public function remove():void
		{
			if (main.contains(text.sprite))
			{
				main.removeChild(text.sprite);
			}
			if (main.contains(barNameLabel.sprite))
			{
				main.removeChild(barNameLabel.sprite);
			}
			if (main.contains(sprite))
			{
				main.removeChild(sprite);
			}
		}

	}

}