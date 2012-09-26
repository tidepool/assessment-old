package
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.utils.getTimer;
	import flash.utils.Timer;
	
	public class Trash
	{
		public var main:Main;
		public var s:Array = new Array();
		//public var trashcan:picture;
		
		public var selected:Boolean;
		public var loaded:Boolean;
		private var elapsedTime:Number;
		
		public function Trash(p_main:Main)
		{
			main = p_main;
		
		}
		
		public function render():void
		{
			new label(main, 300, 20, "", 30, 1000);
			new label(main, 400, 50, "What does your work space look like?");
			
			s.push(new pictureChoice(main, this, 400, 275, "assets/Trash/claustrophobic space.jpg", "Claustrophobic Space", 225));
			s.push(new pictureChoice(main, this, 800, 275, "assets/Trash/cubicle.jpg", "Cubicle", 225));
			s.push(new pictureChoice(main, this, 1200, 275, "assets/Trash/home office.jpg", "Home Office", 225));
			s.push(new pictureChoice(main, this, 400, 550, "assets/Trash/large office.jpg", "Large Office", 225));
			s.push(new pictureChoice(main, this, 800, 550, "assets/Trash/other.jpg", "Other", 225));
			s.push(new pictureChoice(main, this, 1200, 550, "assets/Trash/small office.jpg", "Small Office", 225));
			
			for (var i:int = 0; i < s.length; i++)
			{
				s[i].l.text.y -= 75;
			}
			
			//trashcan = new picture(main, 1500, 700, "assets/Trash/trashcan.png",200);
			selected = false;
			loaded = false;
			main.getTime()
		}
		
		public function update():void
		{
			
			for (var i:int = 0; i < s.length; i++)
			{
				s[i].update();
			}
			//trashcan.update();
			if (selected)
			{
				for (i = 0; i < s.length; i++)
				{
					if (!s[i].selected)
						s[i].sprite.alpha -= 0.05;
				}
			}
			if ((!loaded && s[0].sprite.alpha < 0.1) || (!loaded && s[1].sprite.alpha < 0.1))
			{
				loaded = true;
			}
			if (selected)
			{
				main.displayNext();
			}
		}
		
		public function keyPress():void
		{
		
		}
		
		public function writeXML():void
		{
			if (s[0].selected)
			{
				main.xmlString += "<trash>1</trash>";
			}
			else if (s[1].selected)
			{
				main.xmlString += "<trash>2</trash>";
			}
			else if (s[2].selected)
			{
				main.xmlString += "<trash>3</trash>";
			}
			else if (s[3].selected)
			{
				main.xmlString += "<trash>4</trash>";
			}
			else if (s[4].selected)
			{
				main.xmlString += "<trash>5</trash>";
			}
			else if (s[5].selected)
			{
				main.xmlString += "<trash>6</trash>";
			}
			else
			{
				main.xmlString += "<trash>ERROR</trash>";
			}
			main.changesString += "<trash>" + main.getTime() + "</trash>";
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
		
		public function click():void
		{
			//	main.showNextButton();
			selected = true;
			for (var i:int = 0; i < s.length; i++)
			{
				if (!s[i].selected)
					s[i].calculateDes();
			}
		}
	}

}