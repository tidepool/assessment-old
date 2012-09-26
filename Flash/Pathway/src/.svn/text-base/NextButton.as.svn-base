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
	
	public class NextButton extends MovieClip
	{
		private var main:Main;
		private var positionX:Number;
		private var positionY:Number;
		private var nextButton:Loader = new Loader();
		private var nextButtonOver:Loader = new Loader();
		
		public function NextButton(p_main:Main, p_x:Number, p_y:Number)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			nextButton.load(new URLRequest(main.prefix + "assets/nextButton.png"));
			nextButton.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			nextButtonOver.load(new URLRequest(main.prefix + "assets/nextButton-Over.png"));
			nextButtonOver.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			
			nextButtonOver.addEventListener(MouseEvent.CLICK, click);
			nextButton.addEventListener(MouseEvent.MOUSE_OVER, over);
			nextButtonOver.addEventListener(MouseEvent.MOUSE_OUT, out);
		}
		
		public function onLoaderReady(e:Event):void
		{
			nextButton.x = positionX - nextButton.width / 2;
			nextButton.y = positionY - nextButton.height / 2;
			nextButtonOver.x = nextButton.x;
			nextButtonOver.y = nextButton.y;
		
		}
		
		public function over(e:Event):void
		{
			if (main.contains(nextButtonOver))
			{
				main.setChildIndex(nextButtonOver, main.numChildren - 1);
			}
		}
		
		public function out(e:Event):void
		{
			if (main.contains(nextButton))
			{
				main.setChildIndex(nextButton, main.numChildren - 1);
			}
		}
		
		public function add():void
		{
			if (!main.contains(nextButton))
			{
				main.addChild(nextButton);
			}
			if (!main.contains(nextButtonOver))
			{
				main.addChild(nextButtonOver);
			}
			
			main.setChildIndex(nextButtonOver, main.numChildren - 2);
			main.setChildIndex(nextButton, main.numChildren - 1);
		}
		
		public function remove():void
		{
			if (main.contains(nextButton))
			{
				main.removeChild(nextButton);
			}
			if (main.contains(nextButtonOver))
			{
				main.removeChild(nextButtonOver);
			}
		}
		
		public function click(e:Event):void
		{
			remove()
			main.writeXML();
		}
	}
}