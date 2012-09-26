package  
{
	import flash.display.Loader;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.net.URLRequest;

	public class BarControl
	{
		private var main:Main;
		private var positionX:Number;
		private var positionY:Number;
		private var pic:Picture;
		private var l:Label;
		private var frame:Loader;
		
		public function BarControl(p_main:Main, p_x:Number,p_y:Number,textString:String="") 
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			
			frame = new Loader();
			frame.load(new URLRequest(main.prefix + "assets/frame.png"));			
			frame.contentLoaderInfo.addEventListener(Event.COMPLETE, frameLoaderReady);
			main.addChild(frame);
			l = new Label(main, positionX - 90, positionY - 15, textString, 18, 180);	
			if (l.text.length > 20)
			{
				l.sprite.y -= 10;
				l.format1.size = 16;
				//l.text.setTextFormat(l.format1);
			}
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
			if (main.contains(frame) && main.contains(l.sprite))
			{
				main.setChildIndex(frame, main.numChildren - 1);	
				main.setChildIndex(l.sprite, main.numChildren - 1);		
			}
			
		}		
	}
}