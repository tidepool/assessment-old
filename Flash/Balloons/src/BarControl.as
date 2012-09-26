package  
{
	import flash.display.Loader;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.net.URLRequest;

	public class BarControl
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var pic:Picture;
		public var l:Label;
		public var isMouseIn:Boolean;
		public var hasSetIndex:Boolean=false;
		
		public var scale:Number = 0.8;
		public var value:int;
		public var balloon:Balloon;
		private var frame:Loader;
		private var balloonScale:Number;
		private var balloonPosition:Number;
		
		public function BarControl(p_main:Main, b:Balloon, p_x:Number,p_y:Number,textString:String="") 
		{
			balloon = b;
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			
			balloonScale = 0;
			balloonPosition = 0;
			
			frame = new Loader();
			frame.load(new URLRequest(main.prefix + "assets/frame.png"));			
			frame.contentLoaderInfo.addEventListener(Event.COMPLETE, frameLoaderReady);
			main.addChild(frame);
			l = new Label(main,positionX,positionY,textString,22,150);
			
			
		}
		public function frameLoaderReady(e:Event) :void
		{
			main.addChild(frame);
			
			
			var a:Number = frame.width;
			if (frame.height > a)
			{
				a = frame.height;
			}
			var scale:Number = 1 / a * length;
			frame.x = positionX - frame.width / 2;
			frame.y = positionY - frame.height / 2;
			if (main.contains(frame))
			{
				main.setChildIndex(frame,2);
			}
		} 
		
		public function update():void
		{
			balloon.positionY += balloonPosition;
			balloon.scale += balloonScale;
			
			if (main.contains(frame) && main.contains(l.sprite))
			{
				main.setChildIndex(frame, main.numChildren - 1);	
				main.setChildIndex(l.sprite, main.numChildren - 1);		
			}
			
		}		
	}
}