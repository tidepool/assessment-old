package
{
	import flash.events.KeyboardEvent;
	import flash.ui.Keyboard;
	
	public class Dream
	{
		public var main:Main;
		public var s:Array = new Array();
		public var p:picture;
		
		public function Dream(p_main:Main)
		{
			main = p_main;
		}
		
		public function render():void
		{
			new label(main, 500, 550, "Select your ideal work space.", 35, 600);
			
			s.push(new pictureButtonDream(main, this, 275, 100, "1", "It may look messy to some people, but that’s how I prefer it."));
			s.push(new pictureButtonDream(main, this, 575, 100, "2", "Organized and neat"));
			s.push(new pictureButtonDream(main, this, 875, 100, "3", "Somewhat messy, but organized in its own way"));
			s[2].l.text.y += 50;
			
			p = new picture(main, 800, 400, "assets/Dream/thoughtBubble.png", 1600);
			//	new pictureButton(main,1100,600,"assets/WLBCurrent/12. Dream cloud/sleeping.png",0.5);
			main.getTime();
		}
		
		public function update():void
		{
			
			if (main.contains(p.sprite))
			{
				main.setChildIndex(p.sprite, 0);
			}
		}
		
		public function writeXML():void
		{
			
			if (s[0].isSelected)
			{
				main.xmlString += "<dream>1</dream>";
			}
			else if (s[1].isSelected)
			{
				main.xmlString += "<dream>2</dream>";
			}
			else if (s[2].isSelected)
			{
				main.xmlString += "<dream>3</dream>";
			}
			else
			{
				main.xmlString += "<dream>ERROR</dream>";
			}
			main.changesString += "<dream>" + main.getTime() + "</dream>";
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