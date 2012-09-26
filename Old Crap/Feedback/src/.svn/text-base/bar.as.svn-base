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
		public var finalScale:Number;
		public var barNameLabel:label;
		public var type:int;
		public var stdSprite:Sprite=new Sprite();
		public var shouldDrawStd:Boolean = true;
		
		
		public function bar(p_main:Main,p_x:Number,p_y:Number,p_name:String,p_type:int)
		{
			main = p_main;
			positionX = p_x;
			if (p_type == 1)
			{
				positionY = p_y;
			}
			else if (p_type == 2)
			{
				positionY = p_y + 20;
			}
			else
			{
				positionY = p_y;
			}
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			barName = p_name;
			type = p_type;
		}
		
		public function onLoaderReady(e:Event) :void
		{
			sprite.addChild(myLoader);
			main.addChild(sprite);
			
			scale = value*3;
			sprite.scaleY = 0.125;
			sprite.x = positionX ;
			sprite.y = positionY ;
			text = new label(main, positionX, positionY + 7, int(value * 100) + "%");
			barNameLabel=new label(main, positionX - 170, positionY , barName);
			sprite.scaleX = 0;
		}
		
		public function drawBar(p_value:Number,scale:Number):void
		{
			var fileRequest:URLRequest;
			if (type == 2)
			{
				fileRequest = new URLRequest("assets/Feedback/barBlue.png");
			}
			else
			{
				fileRequest = new URLRequest("assets/Feedback/bar.png");
			}
			myLoader.load(fileRequest);
			value = p_value;
			finalScale = scale*1.6;
		}
		
		public function update():void
		{
			if (main.contains(sprite))
			{
				sprite.scaleX = sprite.scaleX + (finalScale-sprite.scaleX) / 20;
				var px:Number = positionX + myLoader.width * sprite.scaleX / 2 - text.text.textWidth / 2;
				if (type == 3)
				{
					sprite.scaleY = 0.4;
					text.changeText(px, positionY +7, 25, (int)(value  * sprite.scaleX / finalScale));
				}
				else
				{
					text.changeText(px, positionY -5, 17, (int)(value  * sprite.scaleX / finalScale));
				}
				
				if (sprite.scaleX > finalScale * 0.98)
				{
					sprite.scaleX = finalScale;
					if (type == 3&&shouldDrawStd)
					{
						shouldDrawStd = false;
						var ox:Number = positionX + myLoader.width * sprite.scaleX;
						var len :Number= Math.random() * 50 + 10;
						stdSprite = new Sprite();
						main.addChild(stdSprite);
						stdSprite.graphics.beginFill(0xFF0000);
						stdSprite.graphics.drawRect(ox-len/2,positionY+16,len,4);
						stdSprite.graphics.endFill();
					}
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
			if (main.contains(stdSprite))
			{
				main.removeChild(stdSprite);
			}
		}

	}

}