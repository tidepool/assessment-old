package  
{
	import flash.display.Loader;
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.utils.getTimer;
	import flash.net.URLRequest;
	
	public class ContinueScreen 
	{
		public var main:Main;
		public var text1:Label;
		public var submitButton:Loader;
		public var submitButtonOver:Loader = new Loader();
		
		public function ContinueScreen(p_main:Main) 
		{
			main = p_main;
			text1 = new Label(main, 0, 0, "");
		}
		
		public function render():void
		{
			main.graphics.clear();
			text1.changeText(400, 200, 45, "Thank you, we have recorded your responses and will now provide you with feedback.");
			submitButton = new Loader();
			submitButton.load(new URLRequest(main.prefix + "assets/submitButton.png"));
			submitButtonOver.load(new URLRequest(main.prefix + "assets/submitButton-Over.png"));
			submitButton.contentLoaderInfo.addEventListener(Event.COMPLETE, onNextButtonReady);
			submitButton.addEventListener(MouseEvent.CLICK,click);
			submitButtonOver.contentLoaderInfo.addEventListener(Event.COMPLETE, onNextButtonReady);
			submitButtonOver.addEventListener(MouseEvent.CLICK, click);
			
			submitButton.addEventListener(MouseEvent.MOUSE_OVER, over);
			submitButtonOver.addEventListener(MouseEvent.MOUSE_OUT, out);
		}
		public function onNextButtonReady(e:Event) :void
		{   			
			var width:Number = submitButton.width;
			submitButton.x = 800 - submitButton.width / 2;
			submitButton.y = 700;		
			submitButtonOver.x = 800 - submitButtonOver.width / 2;
			submitButtonOver.y = 700;	
			
			
			if (!main.contains(submitButtonOver))
			{
				main.addChild(submitButtonOver);		
			}
			if (!main.contains(submitButton))
			{
				main.addChild(submitButton);		
			}
			
			if (main.contains(submitButton))
			{
				main.setChildIndex(submitButton,main.numChildren-1);		
			}		
		}
		
		public function update():void
		{
		}
		
		public function over(e:Event):void
		{
			main.setChildIndex(submitButtonOver, main.numChildren-1);
		}
		public function out(e:Event):void
		{
			main.setChildIndex(submitButton, main.numChildren-1);
		}
		
		
		public function keyPress():void
		{
			
		}
		
		public function writeXML():void
		{
			main.xmlString += "</pictureSelection>";			
			main.xmlString += "<response>";
		}
				
		public function click(e:Event):void
		{
			
			submitButton.removeEventListener(MouseEvent.CLICK,click);
			submitButtonOver.contentLoaderInfo.removeEventListener(Event.COMPLETE, onNextButtonReady);
			submitButtonOver.removeEventListener(MouseEvent.CLICK, click);
			
			submitButton.removeEventListener(MouseEvent.MOUSE_OVER, over);
			submitButtonOver.removeEventListener(MouseEvent.MOUSE_OUT, out);
			
			while (main.numChildren > 0)
			{
				main.removeChildAt(0);
			}
			main.displayNext();
		}
		
	}

}