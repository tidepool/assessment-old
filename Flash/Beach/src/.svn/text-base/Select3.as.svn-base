package
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.utils.getTimer;
	
	public class Select3
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
		public var s1:String;
		public var s2:String;
		public var s3:String;
		public var selected:Boolean;
		public var loaded:Boolean;
		
		private var changes:String;
		
		public function Select3(p_main:Main, p_folder:String, p_ques:String, p_pic1:String, p_pic2:String, p_pic3:String, ps1:String, ps2:String, ps3:String, p_case1:String, p_case2:String)
		{
			main = p_main;
			
			folder = p_folder;
			question = p_ques;
			pic1 = p_pic1;
			pic2 = p_pic2;
			pic3 = p_pic3;
			case1 = p_case1;
			case2 = p_case2;
			s1 = ps1;
			s2 = ps2;
			s3 = ps3;
			changes = "";
		}
		
		public function render():void
		{
			//	new label(main,300,100,"Select the picture that most accurately answers the question.  Is your work culture acceptable to you in the following ways:",20,1000);
			new Label(main, 800, 125, question, 30, 1000, true);
			
			new NextButton(main, 1250, 750);
			
			s.push(new pictureSelect(main, 400, 300, folder + pic1 + ".png", s1, 150, "option1", this));
			s.push(new pictureSelect(main, 800, 300, folder + pic2 + ".png", s2, 150, "option2", this));
			s.push(new pictureSelect(main, 1200, 300, folder + pic3 + ".png", s3, 150, "option3", this));
			
			p = new picture(main, 800, 600, case1, 400);
			selected = false;
			loaded = false;
			main.taskTime = getTimer();
		}
		
		public function recordChanges(ind:int):void
		{
			main.timeDiff = getTimer() - main.taskTime;
			main.taskTime = getTimer();
			changes += "*" + ind + "@" + main.timeDiff;
			trace(changes);
		}
		
		public function update():void
		{
			
			for (var i:int = 0; i < s.length; i++)
			{
				s[i].update();
			}
			p.update();
			
			if (!loaded && (s[0].sprite.alpha < 0.1 || s[1].sprite.alpha < 0.1 || s[2].sprite.alpha < 0.1))
			{
				loaded = true;
				p.remove();
				p = new picture(main, 800, 600, case2, 400);
			}
		}
		
		public function keyPress():void
		{
		
		}
		
		public function writeXML():void
		{
			main.changesString += "<multi3>" + changes + "</multi3>";
			main.xmlString += "<multi3>";
			for (var i:int = 0; i < s.length; i++)
			{
				
				main.xmlString += "<" + s[i].xmlData + ">";
				
				main.xmlString += s[i].selected + "";
				main.xmlString += "</" + s[i].xmlData + ">";
			}
			main.xmlString += "</multi3>";
			trace(main.changesString);
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
		
		public function click(ind:int = -1):void
		{
			recordChanges(ind);
			selected = true;
		}
	}

}