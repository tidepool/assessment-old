package  
{
	import flash.events.Event;
	import flash.utils.getTimer;
	/**
	 * ...
	 * @author Wei
	 */
	public class PreloadingImage 
	{
		private var main:Main;
		public var pic:Picture;
		private var positionX:Number;
		private var positionY:Number;
		public var timer:int;
		public var length:Number = 150;
		public function PreloadingImage(p_main:Main,px:Number,py:Number) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			pic = new Picture(main, positionX, positionY, "assets/loader.png", length);
			main.stage.addEventListener(Event.ENTER_FRAME, update);
			timer = getTimer();
		}
		
		public function update(e:Event=null):void
		{
			if (getTimer()-timer > 40)
			{
				timer = getTimer();
			}
			else
			{
				return;
			}
			pic.sprite.rotation -= 360/12-7;
			pic.setPosition(positionX, positionY);
			var rad:Number = pic.sprite.rotation/180*Math.PI;
			
			var ax:Number = length/2;
			var ay:Number = length/2;
			var offsetx:Number = ax*Math.cos(rad)-ay*Math.sin(rad);
			var offsety:Number = ax*Math.sin(rad)+ay*Math.cos(rad);
			pic.sprite.x = positionX -offsetx;
			pic.sprite.y = positionY -offsety;
		}
		
	}

}