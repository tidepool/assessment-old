package  
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;

	public class Briefcase
	{
		public var main:Main;
		public var s:Array = new Array();
		public var p:picture;
		
		public var question:String;
		public var pic1:String;
		public var pic2:String;
		public var pic3:String;
		
		public var nextTimer:int = 100;
		public var nextFlag:Boolean = false;
		
		public var selected:Boolean;
		public var loaded:Boolean;
		private var index:int;
		
		public function Briefcase(p_main:Main,ind:int,p_ques:String,p_pic1:String,p_pic2:String,p_pic3:String) 
		{
			main = p_main;
			
			index = ind;
			question = p_ques;
			pic1 = p_pic1;
			pic2 = p_pic2;
			pic3 = p_pic3;			
		}
		
		public function render():void
		{
			new label(main, 200, 125, question,35,1200);
			s.push(new pictureSelect(main, this, 400, 375, "assets/Briefcase/" + index + "/1.jpg", pic1, 300));
			s.push(new pictureSelect(main, this,  800, 375, "assets/Briefcase/" + index + "/2.jpg", pic2, 300));
			s.push(new pictureSelect(main, this,  1200, 375, "assets/Briefcase/" + index +"/3.jpg", pic3, 300));
			/*
			for (var i:int = 0; i < s.length; i++ )
			{
				s[i].sprite.addEventListener(MouseEvent.CLICK, click);
			}
			*/
			selected = false;
			loaded = false;
			main.getTime();
		}
				
		public function keyPress():void
		{
			
		}
		public function update():void
		{
			
		}
		
		public function writeXML():void
		{
			if (s[0].selected)
			{				
				main.xmlString += "<value>1</value>";
			}
			else if (s[1].selected)
			{				
				main.xmlString += "<value>2</value>";
			}
			else if (s[2].selected)
			{				
				main.xmlString += "<value>3</value>";
			}
			main.changesString += "<time>" + main.getTime() + "</time>";
		}
		
		
		public function displayNext():void
		{
			main.displayNext();
		}
		
		public function click(e:Event=null):void
		{
			selected = true;
			nextFlag = true;
			//writeXML();
		}
	}

}