package  
{
	import flash.events.KeyboardEvent;
	import flash.ui.Keyboard;

	public class Family
	{
		public var main:Main;
		public var s:Array = new Array();
		public var p:picture;
		private var instructions:label;
		private var changes:String;
		
		public function Family(p_main:Main) 
		{
			main = p_main;
			changes = "<family>";
		}
		
		public function render():void
		{
			instructions = new label(main, 300, 20, "Does your family wish you spent more time with them than you do at work?");
			instructions.changeWidth(1000);			
			
			s.push(new pictureButtonFamily(main, this, 400, 125, "No, they think I spend the right amount of time at work",1));
			s.push(new pictureButtonFamily(main, this, 800, 125, "Sometimes",2));
			s.push(new pictureButtonFamily(main, this, 1200, 125, "Yes, they would like it if I spent more time at home",3));
			
			p = new picture(main,800,600,"assets/Family/Sad.png",400);
			main.getTime();
		}
		
		public function update():void
		{

			p.update();
		}
		
		public function recordChanges(ind):void
		{
			changes += "*" + ind + "@" + main.getTime();
			trace(changes);
		}
		
		public function writeXML():void
		{
			if (s[0].isSelected)
			{				
				main.xmlString += "<family>no</family>";
			}
			else if (s[1].isSelected)
			{				
				main.xmlString += "<family>sometimes</family>";
			}
			else if (s[2].isSelected)
			{				
				main.xmlString += "<family>yes</family>";
			}
			else 
			{					
				main.xmlString += "<family>ERROE</family>";
			}
				main.changesString += changes+"</family>";
		}
		
		public function keyPress():void
		{
			
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
	}

}