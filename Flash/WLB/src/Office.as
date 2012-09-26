package
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.display.Loader;
	import flash.net.URLRequest;
	
	public class Office
	{
		public var main:Main;
		public var s:Array = new Array();
		public var edge1:pictureButton;
		public var index:int = 1;
		public var decorations:Array = new Array();
		public var places:label;
		
		private var nextButton:Loader;
		private var chosen:Array = new Array();
		private var times:Array = new Array();
		private var door:pictureButton;
		private var windows:Array = new Array();
		
		public function Office(p_main:Main)
		{
			main = p_main;
		}
		
		public function render():void
		{
			for (var i:int = 0; i < 2; i++)
			{
				for (var j:int = 0; j < 4; j++)
				{
					windows.push(new pictureButton(main, 1150 + i * 275, 50 + j * 180, "assets/Office/WindowFrame-ReflectionB.png", 0.65));
				}
			}
			
			door = new pictureButton(main, 1150 + 1 * 275, 50 + 3 * 180, "assets/Office/building-door.png", 0.97);
			places = new label(main, 0, 100, "Decor");
			new label(main, 25, 25, "My work environment is pleasing to me in the following areas:", 30, 880);
			s.push(new pictureButtonOffice(main, this, 170, 180, "1/1", "Awful", 1));
			s.push(new pictureButtonOffice(main, this, 570, 180, "1/3", "Wonderful", 2));
			s.push(new pictureButtonOffice(main, this, 170, 510, "1/2", "Meets my expectations", 3));
			s.push(new pictureButtonOffice(main, this, 570, 510, "1/3", "Wonderful", 4));
			s[3].isActive = false;
			
			edge1 = new pictureButton(main, 965, 50, "assets/Office/buildingEdge.png", 0.92);
			for (i = 0; i < 2; i++)
			{
				for (j = 0; j < 4; j++)
				{
					if (i == 1 && j == 3)
					{
						
						new pictureButton(main, 1150 + i * 275, 50 + j * 180, "assets/Office/DoorFrame.png", 0.65454545);
						break;
					}
					new pictureButton(main, 1150 + i * 275, 50 + j * 180, "assets/Office/WindowFrame.png", 0.65454545);
				}
			}
			
			for (i = 0; i < 7; i++)
			{
				decorations.push(new pictureDecoration(main, 1150 + (i % 2) * 275, 150 + ((int)(i / 2)) * 180, "assets/Family/Sad.png", 200));
			}
			main.getTime();
		}
		
		public function onNextButtonLoaderReady(e:Event):void
		{
			var width:Number = nextButton.width;
			nextButton.x = 800 - nextButton.width / 2;
			nextButton.y = 750;
		}
		
		public function update():void
		{
			
			if (main.contains(edge1.sprite))
			{
				main.setChildIndex(edge1.sprite, 0);
			}
			if (main.contains(door.sprite))
			{
				main.setChildIndex(door.sprite, 0);
			}
			for (var i:int = 0; i < windows.length; i++)
			{
				if (main.contains(windows[i].sprite))
				{
					main.setChildIndex(windows[i].sprite, 0);
				}
			}
		}
		
		public function keyPress():void
		{
		
		}
		
		public function displayNext():void
		{
			main.graphics.clear();
			
			times[index - 1] = main.getTime();
			index++;
			if (index == 2)
			{
				places.changeText(0, 100, 35, "Personal work space");
				s[0].changePicture(index + "/1", "Below my expectations");
				s[1].changePicture(index + "/2", "Exceeds my expectations");
				s[2].changePicture(index + "/3", "Meets my expectatios");
			}
			else if (index == 3)
			{
				places.changeText(0, 100, 35, "Kitchen space");
				s[0].changePicture(index + "/1", "Above my expectations");
				s[1].changePicture(index + "/2", "Below my expectations");
				s[2].changePicture(index + "/3", "Meets my expectatios");
				s[3].changePicture(index + "/4", "Not applicable");
				s[3].isActive = true;
			}
			else if (index == 4)
			{
				places.changeText(0, 100, 35, "Computing equipment");
				s[0].changePicture(index + "/1", "Above average");
				s[1].changePicture(index + "/2", "Average");
				s[2].changePicture(index + "/3", "Below average");
				s[3].changePicture(index + "/4", "Not applicable");
			}
			else if (index == 5)
			{
				places.changeText(0, 100, 35, "Restrooms");
				s[0].changePicture(index + "/1", "Below my expectations");
				s[1].changePicture(index + "/2", "Meets my expectations");
				s[2].changePicture(index + "/3", "Exeeds my expectations");
				s[3].isActive = false;
			}
			else if (index == 6)
			{
				places.changeText(0, 100, 35, "Relaxation space");
				s[0].changePicture(index + "/1", "Average");
				s[1].changePicture(index + "/2", "Luxury");
				s[2].changePicture(index + "/3", "Minimal");
				s[3].changePicture(index + "/4", "Nonexistant");
				s[3].isActive = true;
			}
			else if (index == 7)
			{
				places.changeText(0, 100, 35, "Exercise space");
				s[0].changePicture(index + "/1", "Average");
				s[1].changePicture(index + "/2", "Luxury");
				s[2].changePicture(index + "/3", "Minimal");
				s[3].changePicture(index + "/4", "Nonexistant");
			}
			else
			{
				main.changesString += "</briefcase>";
				main.changesString += "<office>";
				
				main.xmlString += "</briefcase>";
				main.xmlString += "<office>";
				
				for (i = 0; i < 7; i++)
				{
					main.changesString += "<time>" + times[i] + "</time>";
					main.xmlString += "<value>" + chosen[i] + "</value>";
				}
				main.changesString += "</office>";
				main.xmlString += "</office>";
				
				trace(main.xmlString);
				main.displayNext();
			}
			for (var i:int = 0; i < s.length; i++)
			{
				s[i].isSelected = false;
			}
		
		}
		
		public function writeXML():void
		{
		}
		
		public function decorate(s:String, id:int):void
		{
			if (index != 7)
			{
				decorations[index - 1].loadNew(s);
				decorations[index - 1].setLength(270);
			}
			chosen[index - 1] = id;
			displayNext();
		}
	}

}