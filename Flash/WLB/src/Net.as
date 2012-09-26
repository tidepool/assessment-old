package
{
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.utils.getTimer;
	import flash.utils.Timer;
	
	public class Net
	{
		public var main:Main;
		public var s:Array = new Array();
		public var p:DragablePic;
		public var string:String;
		public var picName:String
		public var destination:NetKit = null;
		public var isSelected:Boolean = false;
		public var nets:Array = new Array();
		public var butterFly:pictureButton;
		public var hasDisplayedButterfly:Boolean = false;
		private var elapsedTime:Number;
		
		public function Net(p_main:Main, p_name:String, p_s:String)
		{
			main = p_main;
			string = p_s;
			picName = p_name;
			elapsedTime = 0;
		}
		
		public function render():void
		{
			new label(main, 200, 25, "What is most important in your work?", 35, 1200);
			
			p = new DragablePic(main, 800, 125, "", "assets/Nets/" + picName, string);
			nets.push(new NetKit(main, this, 400, 505, "assets/Nets/red-net.jpg", 0.6, true, "Not important"));
			nets.push(new NetKit(main, this, 800, 435, "assets/Nets/blue-net.jpg", 0.8, false, "Somewhat important"));
			nets.push(new NetKit(main, this, 1200, 375, "assets/Nets/purple-net.jpg", 1, false, "Very important"));
			main.getTime();
		}
		
		public function setStatusSlected():void
		{
			isSelected = true;
		}
		
		public function update():void
		{
			if (isSelected)
			{
				p.sprite.x = (p.sprite.x + destination.positionX) / 2;
				p.sprite.y = (p.sprite.y + destination.positionY) / 2;
				p.sprite.alpha *= 0.8;
				p.text.alpha *= 0.8;
				if (p.sprite.alpha < 0.1)
				{
					if (!hasDisplayedButterfly)
					{
						displayButterfly();
					}
				}
			}
			p.update();
			
			if (getTimer() - elapsedTime > 500 && elapsedTime != 0)
			{
				elapsedTime = 0;
				if (main.contains(butterFly.sprite))
				{
					main.removeChild(butterFly.sprite);
				}
				displayNext();
			}
		}
		
		public function displayButterfly():void
		{
			hasDisplayedButterfly = true;
			var status:int = 0;
			if (destination == nets[0])
			{
				status = 1;
			}
			else if (destination == nets[1])
			{
				status = 2;
			}
			else if (destination == nets[2])
			{
				status = 3;
			}
			if (status == 1)
			{
				butterFly = new pictureButton(main, 430, 510, "assets/Nets/blue-butterfly.png", 0.2);
				elapsedTime = getTimer();
				main.xmlString += "<set>1</set>";
			}
			else if (status == 2)
			{
				butterFly = new pictureButton(main, 830, 460, "assets/Nets/orange-butterfly.png", 0.3);
				elapsedTime = getTimer();
				main.xmlString += "<set>2</set>";
			}
			else if (status == 3)
			{
				butterFly = new pictureButton(main, 1230, 390, "assets/Nets/yellow-butterfly.png", 0.5);
				elapsedTime = getTimer();
				main.xmlString += "<set>3</set>";
			}
			main.changesString += "<time>" + main.getTime() + "</time>";
			//trace(main.xmlString);
		}
		
		public function writeXML():void
		{
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