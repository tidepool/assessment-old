package  
{
	import flash.events.*;
	import flash.ui.Keyboard;
	
	public class WorkLifeSlider2 
	{
		public var main:Main;
		public var s:slider;
		private var pic1:picture;
		private var pic2:picture;
		private var pic3:picture;
		private var l1:label;
		private var l2:label;
		private var l3:label;
		
		public function WorkLifeSlider2(p_main:Main) 
		{
			main = p_main;
		}
		
		public function render():void
		{
			s = new slider(main, 250, 660, 1100, "","");
			pic1 = new picture(main, 400, 310, "assets/WorkLife2/1.jpg", 300);
			pic2 = new picture(main, 800, 310, "assets/WorkLife2/2.jpg", 300);
			pic3 = new picture(main,1200,310,"assets/WorkLife2/3.jpg",300);
			new label(main, 400, 50, "Use the slider to indicate which picture best represents your work situation.");
			
			
			l1=new label(main, 290, 510, "It’s not ideal. I wish my schedule were much different, but I make the most of it", 20, 200);
			l2=new label(main, 690, 510, "It’s pretty balanced. There are still some things I would like to change, though", 20, 200);
			l3 = new label(main, 1110, 510, "The balance between my home and work life is perfect. I wouldn't change a thing", 20, 200);
			main.getTime();
		}
		public function update():void
		{
		s.update();
			var weight:Number = 0.2;
			var dec:Number = s.percentage / 100;
			pic1.sprite.alpha = (1 - dec) + weight;
			if (s.percentage >= 0.5)
			{
				pic2.sprite.alpha = 1 - (dec-0.5 + weight);
			}
			else
			{
				pic2.sprite.alpha = 1 - (0.5 - dec + weight);
			}
			pic3.sprite.alpha = dec + weight;
			l1.text.alpha = (1 - dec) + weight;
			if (dec >= 0.5)
			{
				l2.text.alpha = 1 - (dec-0.5 + weight);
			}
			else
			{
				l2.text.alpha = 1 - (0.5 - dec + weight);
			}
			l3.text.alpha = dec + weight;
		}
		
		public function keyPress():void
		{
			
		}
		
		public function writeXML():void
		{			
			main.changesString += "<slider2>" + s.changes + "</slider2>";
			main.xmlString += "<slider2>" + s.percentage + "</slider2>";			
			main.stage.removeEventListener(MouseEvent.CLICK, s.clickOnBar);
			main.stage.removeEventListener(MouseEvent.MOUSE_MOVE, s.move);
			main.stage.removeEventListener(MouseEvent.MOUSE_UP, s.move);
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
	}

}