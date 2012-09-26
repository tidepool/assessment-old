package
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.ui.Mouse;
	import flash.utils.getTimer;
	
	public class SurfSelect
	{
		public var main:Main;
		public var shouldDisplaySurfer:Boolean = true;
		public var surfer:picture;
		public var next:NextButton;
		
		public var truePic:SurfSelectPic;
		public var falsePic:SurfSelectPic;
		public var isSelected:Boolean = false;
		
		public function SurfSelect(p_main:Main)
		{
			main = p_main;
		}
		
		public function render():void
		{
			new Label(main, 800, 100, "I am curious", 30, 1000, true);
			surfer = new picture(main, main.mouseX, main.mouseY, "assets/Surf/s2.png", 150);
			showplate();
			truePic = new SurfSelectPic(main, 500, 425, "assets/Surf/wave1.jpg", "True", 350, this, 0);
			falsePic = new SurfSelectPic(main, 1100, 425, "assets/Surf/wave2.jpg", "False", 350, this, 0);
			main.taskTime = getTimer();
		}
		
		public function update():void
		{
			if (shouldDisplaySurfer)
			{
				surfer.setPosition(main.mouseX, main.mouseY);
			}
			setIndex();
			if (isSelected)
			{
				hideplate();
				displayNext();
			}
		}
		
		public function selected():void
		{
			isSelected = true;
		}
		
		public function setIndex():void
		{
		}
		
		public function hideplate():void
		{
			shouldDisplaySurfer = false;
			if (main.contains(surfer.sprite))
			{
				main.removeChild(surfer.sprite);
			}
			Mouse.show();
		}
		
		public function showplate(e:Event = null):void
		{
			shouldDisplaySurfer = true;
			if (!main.contains(surfer.sprite))
			{
				main.addChild(surfer.sprite);
			}
			Mouse.hide();
		}
		
		public function writeXML():void
		{
			main.changesString += "</tug>";
			main.changesString += "<surfing>";
			main.changesString += "<surf>" + main.timeDiff + "</surf>";
			
			main.xmlString += "</tug>";
			main.xmlString += "<surfing>";
			main.xmlString += "<" + "surf" + ">";
			
			if (truePic.isSelected)
			{
				main.xmlString += "true" + "";
			}
			else
			{
				main.xmlString += "false" + "";
			}
			main.xmlString += "</" + "surf" + ">";
		}
		
		public function displayNext():void
		{
			hideplate();
			main.displayNext();
		}
	}

}