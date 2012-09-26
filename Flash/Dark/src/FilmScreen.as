package  
{
	import flash.display.Loader;
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.net.URLRequest;
	import flash.utils.getTimer;
	
	public class FilmScreen 
	{
		public var main:Main;
		public var startTime:Number;
		public var text:Label;
		public var texts:Array;
		public var index:int;
		public var pic:PictureButton;
		public var bar:PicDragBar;
		public var submitButton:Loader;
		public var submitButtonOver:Loader=new Loader();
		private var instructions:Label;
		
		public function FilmScreen(p_main:Main) 
		{
			main = p_main;
		}
		
		public function render():void
		{
			//main.graphics.beginFill(0, 1);
			//main.graphics.drawCircle(500, 500, 2000);
			//main.graphics.endFill();
			
			instructions = new Label(main, 200, 100, "These photos are segments in an upcoming film. Please slide them into an order that makes sense to you.", 45);
			instructions.changeWidth(1200);
			
			bar = new PicDragBar(main);
			bar.setInitial();
			submitButton = new Loader();
			submitButton.load(new URLRequest(main.prefix + "assets/submitButton.png"));
			submitButtonOver.load(new URLRequest(main.prefix + "assets/submitButton-Over.png"));
			submitButton.contentLoaderInfo.addEventListener(Event.COMPLETE, onSubmitButtonReady);
			submitButton.addEventListener(MouseEvent.CLICK, click);
			submitButtonOver.contentLoaderInfo.addEventListener(Event.COMPLETE, onSubmitButtonReady);
			submitButtonOver.addEventListener(MouseEvent.CLICK, click);
			
			
			submitButton.addEventListener(MouseEvent.MOUSE_OVER, over);
			submitButtonOver.addEventListener(MouseEvent.MOUSE_OUT, out);
			main.taskTime = getTimer();
		}
		
		public function update():void
		{
			bar.update();
			
			if (bar.count >= 5)
			{			
			//	main.addChild(submitButton);
			//	main.addChild(submitButtonOver);
			}
		}
		public function onSubmitButtonReady(e:Event) :void
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
		}
		
		public function click(e:Event):void
		{
			
			
			submitButton.removeEventListener(MouseEvent.CLICK,click);
			submitButtonOver.removeEventListener(MouseEvent.CLICK, click);
			
			submitButton.removeEventListener(MouseEvent.MOUSE_OVER, over);
			submitButtonOver.removeEventListener(MouseEvent.MOUSE_OUT, out);
					
			if (bar.changed)
			{
				bar.changes = bar.changes.substring(0, bar.changes.length - 3);
			}			
			main.timeDiff = getTimer() - main.taskTime;
			bar.changes += " *@" + main.timeDiff;
			main.changeString += "<dragsort>"+bar.changes+"</dragsort>";
			main.xmlString += "</response>";
			main.xmlString += "<ordering>";
			for (var i:int = 0; i < bar.pictureDrags.length; i++ )
			{
				var length:int = bar.pictureDrags[i].picString.length;
				var name:String = bar.pictureDrags[i].picString.substring(7, length - 5);		
				main.stringsSort.push(bar.pictureDrags[i].picString);
				var count:int = i + 1;
				main.xmlString += "<choice" + count + ">";
				main.xmlString += name;			
				main.xmlString += "</choice" + count + ">";			
			}
			main.xmlString += "</ordering>";
			
			while (main.numChildren > 0)
			{
				main.removeChildAt(0);
			}
			main.displayNext();
		}
		
		
	}

}