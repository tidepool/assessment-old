package  
{
	import flash.events.*;
	import flash.ui.Keyboard;
	
	public class WorkLifeSlider1 
	{
		public var main:Main;
		public var s:slider;
		private var pic1:picture;
		private var pic2:picture;
		private var pic3:picture;
		private var l1:label;
		private var l2:label;
		private var l3:label;
		private var instructions:label;
		public function WorkLifeSlider1(p_main:Main) 
		{
			main = p_main;
		}
		
		public function render():void
		{
			s = new slider(main, 250, 650, 1100, "","");
			pic1 = new picture(main, 400, 330, "assets/WorkLife1/1.jpg", 300);
			pic2 = new picture(main, 800, 330, "assets/WorkLife1/2.jpg", 300);
			pic3 = new picture(main,1200,330,"assets/WorkLife1/3.jpg",300);
			instructions = new label(main, 400, 50, "Use the slider to indicate which picture best represents your work situation.");
			
			
			l1=new label(main, 290, 530, "I feel that I work more hours than is expected", 20, 200);
			l2=new label(main, 690, 530, "I feel I work the right amount of hours", 20, 200);
			l3=new label(main, 1110, 530, "I feel that I work the minimum number of hours, but I still get the job done", 20, 200);
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
			main.changesString += "<slider1>" + s.changes + "</slider1>" ;
			main.xmlString += "<slider1>" + s.percentage + "</slider1>" ;			
			main.stage.removeEventListener(MouseEvent.CLICK, s.clickOnBar);
			main.stage.removeEventListener(MouseEvent.MOUSE_MOVE, s.move);
			main.stage.removeEventListener(MouseEvent.MOUSE_UP, s.move);
			//trace(main.xmlString);
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
	}

}