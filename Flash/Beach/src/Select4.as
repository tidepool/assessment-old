package
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.utils.getTimer;
	
	public class Select4
	{
		public var main:Main;
		public var s:Array = new Array();
		public var p:picture;
		
		public var folder:String;
		public var question:String;
		public var pic1:String;
		public var pic2:String;
		public var pic3:String;
		public var pic4:String;
		
		public var case1:String;
		public var case2:String;
		
		public var selected:Boolean;
		public var loaded:Boolean;
		public var isSelected:Boolean = false;
		private var elapsedTime:Number;
		
		public function Select4(p_main:Main, p_folder:String, p_ques:String, p_pic1:String, p_pic2:String, p_pic3:String, p_pic4:String, p_case1:String, p_case2:String)
		{
			main = p_main;
			
			folder = p_folder;
			question = p_ques;
			pic1 = p_pic1;
			pic2 = p_pic2;
			pic3 = p_pic3;
			pic4 = p_pic4;
			case1 = p_case1;
			case2 = p_case2;
			elapsedTime = 0;
		}
		
		public function render():void
		{
			//	new label(main,300,100,"Select the picture that most accurately answers the question.  Is your work culture acceptable to you in the following ways:",20,1000);
			new Label(main, 800, 125, question, 30, 1000, true);
			
			s.push(new pictureSelect(main, 200, 300, folder + pic1 + ".png", pic1, 200, "option1"));
			s.push(new pictureSelect(main, 600, 300, folder + pic2 + ".png", pic2, 200, "option2"));
			s.push(new pictureSelect(main, 1000, 300, folder + pic3 + ".png", pic3, 200, "option3"));
			s.push(new pictureSelect(main, 1400, 300, folder + pic4 + ".png", pic4, 200, "option4"));
			
			for (var i:int = 0; i < s.length; i++)
			{
				s[i].sprite.addEventListener(MouseEvent.CLICK, click);
			}
			
			p = new picture(main, 800, 600, case1, 400);
			selected = false;
			loaded = false;
			main.taskTime = getTimer();
		}
		
		public function update():void
		{
			
			for (var i:int = 0; i < s.length; i++)
			{
				s[i].update();
			}
			p.update();
			if (selected)
			{
				for (i = 0; i < s.length; i++)
				{
					s[i].sprite.alpha -= 0.05;
				}
			}
			if (!loaded && s[0].sprite.alpha < 0.1)
			{
				loaded = true;
				p.remove();
				p = new picture(main, 800, 600, case2, 400);
				select();
			}
			if (isSelected)
			{
				if (getTimer() - elapsedTime > 500 && elapsedTime != 0)
				{
					displayNext();
				}
			}
		}
		
		public function select():void
		{
			elapsedTime = getTimer();
			isSelected = true;
		}
		
		public function writeXML():void
		{
			main.changesString += "<multi4>" + main.timeDiff + "</multi4>";
			if (s[0].selected)
			{
				main.xmlString += "<multi4>1</multi4>";
			}
			else if (s[1].selected)
			{
				main.xmlString += "<multi4>2</multi4>";
			}
			else if (s[2].selected)
			{
				main.xmlString += "<multi4>3</multi4>";
			}
			else if (s[3].selected)
			{
				main.xmlString += "<multi4>4</multi4>";
			}
			trace(main.changesString);
		}
		
		public function keyPress():void
		{
		
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
		
		public function click(e:Event = null):void
		{
			selected = true;
		}
	}

}