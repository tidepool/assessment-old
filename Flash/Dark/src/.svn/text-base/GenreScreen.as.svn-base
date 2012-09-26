package  
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.utils.getTimer;
	
	public class GenreScreen 
	{
		public var main:Main;
		public var startTime:Number;
		public var text:Label;
		public var texts:Array;
		public var index:int;
		public var pic:PictureButton;
		public var s1:String;
		public var s2:String;
		public var s3:String;
		public var buttons:Array = new Array();
		
		public function GenreScreen(p_main:Main) 
		{
			main = p_main;
		}
		
		public function render():void
		{
			text = new Label(main, 200, 10, "What kind of movie would you make with these pictures? (Please select on the right)", 45);
			text.changeWidth(1200);
			for (var i:int = 0; i < main.stringsSort.length; i++ )
			{
				pic = new PictureButton(main, i * 240 + 150, 450, 200, main.stringsSort[i]);
			}
			buttons.push(new Option(main, 1300, 225+50, "Comedy",35));
			buttons.push(new Option(main, 1300, 225+100, "Drama",35));
			buttons.push(new Option(main, 1300, 225+150, "Action",35));
			buttons.push(new Option(main, 1300, 225+200, "Documentary",35));
			buttons.push(new Option(main, 1300, 225+250, "Romance",35));
			buttons.push(new Option(main, 1300, 225+300, "Sci Fi/Fantasy",35));
			buttons.push(new Option(main, 1300, 225+350, "Horror",35));
			
			for (i = 0; i < buttons.length; i++ )
			{
				buttons[i].text.addEventListener(MouseEvent.CLICK, click);
			}
			
			main.taskTime = getTimer();
		}
		
		public function update():void
		{

		}
		
		
		
		public function writeXML():void
		{
		}
		
		
		public function keyPress():void
		{
			
		}
		
		public function click(e:Event):void
		{			
			main.xmlString += "<movie>";
			main.xmlString += e.target.text;
			main.xmlString += "</movie>";			
			main.timeDiff = getTimer() - main.taskTime;
			main.changeString += "<genre>" + main.timeDiff + "</genre>";
			main.xmlString += "<sliders>";
			while (main.numChildren > 0)
			{
				main.removeChildAt(0);
			}
			main.displayNext();
		}
		
		
	}

}