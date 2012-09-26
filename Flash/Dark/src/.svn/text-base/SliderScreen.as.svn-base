package  
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.utils.getTimer;
	import flash.display.Loader;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.net.URLRequest;
	
	public class SliderScreen 
	{
		public var main:Main;
		public var startTime:Number;
		public var instructions:Label;
		public var texts:Array;
		public var index:int;
		public var pic:PictureButton;
		public var s1:String;
		public var s2:String;
		public var s3:String;
		public var buttons:Array = new Array();
		public var slider:Slider;		
		public var submitButton:Loader;
		public var submitButtonOver:Loader=new Loader();
		
		public function SliderScreen(p_main:Main,p_index:int) 
		{
			main = p_main;
			index = p_index;
		}
		
		public function render():void
		{
			main.graphics.beginFill(0, 1);
			main.graphics.drawCircle(500, 500, 2000);
			main.graphics.endFill();
			instructions = new Label(main, 300, 25, "Thanks for helping us with your feedback. How well do these terms describe you?", 45);
			instructions.changeWidth(1000);
			new Label(main,400,425,"How much do you agree?",30);

			var label:Label = new Label(main, 400, 225, main.stringsSelected[index], 40);
			label.changeColor(0x0000FF);
				
			slider = new Slider(main, 400, 500, 800, "Disagree","Agree");
			slider.reset();
			
			for (var i:int = 0; i < buttons.length; i++ )
			{
				buttons[i].text.addEventListener(MouseEvent.CLICK, click);
			}
			submitButton = new Loader();
			submitButton.load(new URLRequest(main.prefix + "assets/submitButton.png"));
			submitButtonOver.load(new URLRequest(main.prefix + "assets/submitButton-Over.png"));
			submitButton.contentLoaderInfo.addEventListener(Event.COMPLETE, onNextButtonReady);
			submitButton.addEventListener(MouseEvent.CLICK,click);
			submitButtonOver.contentLoaderInfo.addEventListener(Event.COMPLETE, onNextButtonReady);
			submitButtonOver.addEventListener(MouseEvent.CLICK, click);
			
			
			submitButton.addEventListener(MouseEvent.MOUSE_OVER, over);
			submitButtonOver.addEventListener(MouseEvent.MOUSE_OUT, out);
			main.taskTime = getTimer();
		}
		public function onNextButtonReady(e:Event) :void
		{   			
			var width:Number = submitButton.width;
			submitButton.x = 800 - submitButton.width / 2;
			submitButton.y = 700;	
			submitButtonOver.x = 800 - submitButton.width / 2;
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
		
		
		
		public function over(e:Event):void
		{
			main.setChildIndex(submitButtonOver, main.numChildren-1);
		}
		public function out(e:Event):void
		{
			main.setChildIndex(submitButton, main.numChildren-1);
		}
		
		
		public function writeXML():void
		{
			main.timeDiff = getTimer() - main.taskTime;
			main.changeString += "<slider>" + slider.changes+"</slider>";
			main.xmlString += "<num" + index + ">" + slider.percentage + "</num" + index + ">";			
			main.stage.removeEventListener(MouseEvent.CLICK, slider.clickOnBar);		
			main.stage.removeEventListener(MouseEvent.MOUSE_MOVE, slider.move);		
			main.stage.removeEventListener(MouseEvent.MOUSE_UP, slider.move);
		}
		
		
		public function update():void
		{

			slider.update();
		}
		
		public function keyPress():void
		{
			
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