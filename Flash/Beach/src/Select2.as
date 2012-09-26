package
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.display.Loader;
	import flash.net.URLRequest;
	import flash.utils.getTimer;
	
	public class Select2
	{
		public var main:Main;
		public var s:Array = new Array();
		public var p:picture;
		
		public var folder:String;
		public var question:String;
		public var pic1:String;
		public var pic2:String;
		public var pic3:String;
		public var case1:String;
		public var case2:String;
		
		public var selected:Boolean;
		public var loaded:Boolean;
		public var xmlData:String;
		public var isSelected:Boolean = false;
		public var elapsedTime:Number;
		
		private var background:Loader;
		
		public function Select2(p_main:Main, p_folder:String, p_ques:String, p_pic1:String, p_pic2:String, p_case1:String, p_case2:String, p_data:String)
		{
			main = p_main;
			
			folder = p_folder;
			question = p_ques;
			pic1 = p_pic1;
			pic2 = p_pic2;
			case1 = p_case1;
			case2 = p_case2;
			xmlData = p_data;
			elapsedTime = 0;
		}
		
		public function render():void
		{
			new Label(main, 800, 125, question, 30, 1000, true);
			
			s.push(new pictureSelect(main, 600, 300, folder + pic1 + ".png", pic1, 200));
			s.push(new pictureSelect(main, 1000, 300, folder + pic2 + ".png", pic2, 200));
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
					elapsedTime = 0;
					displayNext();
				}
			}
		}
		
		public function select():void
		{
			elapsedTime = getTimer();
			isSelected = true;
		}
		
		public function keyPress():void
		{
		
		}
		
		public function writeXML():void
		{
			main.changesString += "<" + xmlData + ">" + main.timeDiff + "</" + xmlData + ">";
			main.xmlString += "<" + xmlData + ">";
			
			if (s[0].selected)
			{
				main.xmlString += "true" + "";
			}
			else
			{
				main.xmlString += "false" + "";
			}
			main.xmlString += "</" + xmlData + ">";
			trace(main.changesString);
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