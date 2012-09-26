package
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.ui.Mouse;
	import flash.utils.getTimer;
	
	public class PlacesTrueFalse
	{
		private var main:Main;
		private var trueButton:picture;
		private var falseButton:picture;
		private var trueButtonOver:picture;
		private var falseButtonOver:picture;
		private var url:String;
		private var question:String;
		private var picData:String;
		private var xmlData:String;
		
		public function PlacesTrueFalse(p_main:Main, p_url:String, p_ques:String, p_data:String = "place")
		{
			main = p_main;
			url = p_url;
			question = p_ques;
			xmlData = p_data;
		}
		
		public function render():void
		{
			new Label(main, 800, 100, question, 30, 1000, true);
			new picture(main, 800, 400, url, 400);
			
			trueButtonOver = new picture(main, 400, 400, "assets/False-off.png", 163);
			trueButton = new picture(main, 400, 400, "assets/False-over.png", 163);
			trueButton.sprite.addEventListener(MouseEvent.MOUSE_OVER, trueOver);
			trueButtonOver.sprite.addEventListener(MouseEvent.MOUSE_OUT, trueOut);
			trueButtonOver.sprite.addEventListener(MouseEvent.CLICK, displayNext);
			
			falseButtonOver = new picture(main, 1200, 400, "assets/True-off.png", 163);
			falseButton = new picture(main, 1200, 400, "assets/True-over.png", 163);
			falseButton.sprite.addEventListener(MouseEvent.MOUSE_OVER, falseOver);
			falseButtonOver.sprite.addEventListener(MouseEvent.MOUSE_OUT, falseOut);
			falseButtonOver.sprite.addEventListener(MouseEvent.CLICK, displayNext);
			main.taskTime = getTimer();
		}
		
		public function trueOver(e:Event):void
		{
			if (main.contains(trueButtonOver.sprite))
				main.setChildIndex(trueButtonOver.sprite, main.numChildren - 1);
		}
		
		public function trueOut(e:Event):void
		{
			if (main.contains(trueButton.sprite))
				main.setChildIndex(trueButton.sprite, main.numChildren - 1);
		}
		
		public function falseOver(e:Event):void
		{
			if (main.contains(falseButtonOver.sprite))
				main.setChildIndex(falseButtonOver.sprite, main.numChildren - 1);
		}
		
		public function falseOut(e:Event):void
		{
			if (main.contains(falseButton.sprite))
				main.setChildIndex(falseButton.sprite, main.numChildren - 1);
		}
		
		public function update():void
		{
		
		}
		
		public function writeXML():void
		{
			main.changesString += "<" + xmlData + ">" + main.timeDiff + "</" + xmlData + ">";
			main.xmlString += "<" + xmlData + ">";
			if (trueButton.isSelected)
			{
				main.xmlString += "true" + "";
			}
			else
			{
				main.xmlString += "false" + "";
			}
			main.xmlString += "</" + xmlData + ">";
		}
		
		public function displayNext(e:Event = null):void
		{
			main.displayNext();
		}
	}

}