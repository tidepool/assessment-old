package
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.ui.Mouse;
	import flash.utils.getTimer;
	
	public class SurfMulti
	{
		public var main:Main;
		public var shouldDisplaySurfer:Boolean = true;
		public var surfer:picture;
		public var next:NextButton;
		private var elapsedTime:Number;
		
		public var pics:Array = new Array();
		public var active:Boolean = false;
		public var changes:String;
		
		public function SurfMulti(p_main:Main)
		{
			main = p_main;
		}
		
		public function render():void
		{
			active = true;
			new Label(main, 800, 100, "Choose as many as apply", 30, 1000, true);
			next = new NextButton(main, 800, 750);
			surfer = new picture(main, main.mouseX, main.mouseY, "assets/Surf/s16.png", 111);
			showplate();
			pics.push(new SurfMultiPic(main, 300, 400, "assets/Surf/wave3.jpg", "Experimentation", 250, this, 1, "experiment"));
			pics.push(new SurfMultiPic(main, 600, 400, "assets/Surf/wave4.jpg", "Learning new things", 250, this, 2, "new"));
			pics.push(new SurfMultiPic(main, 900, 400, "assets/Surf/wave5.jpg", "Addressing complex cognitive problems", 250, this, 3, "complex"));
			pics.push(new SurfMultiPic(main, 1200, 400, "assets/Surf/wave6.jpg", "Taking on new challenges", 250, this, 4, "challenge"));
			next.sprite.addEventListener(MouseEvent.CLICK, click)
			main.stage.addEventListener(MouseEvent.MOUSE_MOVE, move);
			changes = "";
			main.taskTime = getTimer();
		}
		
		public function update():void
		{
			if (shouldDisplaySurfer)
			{
				surfer.setPosition(main.mouseX, main.mouseY);
			}
			setIndex();
		}
		
		public function setIndex():void
		{
			if (main.contains(surfer.sprite))
			{
				main.setChildIndex(surfer.sprite, main.numChildren - 1);
			}
			for (var i:int = 0; i < pics.length; i++)
			{
				if (main.contains(pics[i].masksprite))
				{
					main.setChildIndex(pics[i].masksprite, main.numChildren - 1);
				}
			}
			if (main.contains(next.sprite))
			{
				//	main.setChildIndex(next.sprite,main.numChildren-1);
			}
		}
		
		public function recordChanges(ind:int):void
		{
			main.timeDiff = getTimer() - main.taskTime;
			main.taskTime = getTimer();
			changes += "*" + ind + "@" + main.timeDiff;
			trace(changes);
		}
		
		public function click(e:Event = null):void
		{
			active = false;
			main.stage.removeEventListener(MouseEvent.MOUSE_MOVE, move);
			next.sprite.removeEventListener(MouseEvent.MOUSE_MOVE, hideplate);
			next.sprite.removeEventListener(MouseEvent.MOUSE_OUT, showplate);
		}
		
		public function move(e:Event = null):void
		{
			if (!active)
			{
				return;
			}
			
			if (main.mouseY > 600 && shouldDisplaySurfer)
			{
				hideplate();
			}
			if (main.mouseY <= 600 && (!shouldDisplaySurfer))
			{
				showplate();
			}
		}
		
		public function hideplate(e:Event = null):void
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
			main.stage.removeEventListener(MouseEvent.MOUSE_MOVE, move);
			main.changesString += "<multi>" + changes + "</multi>";
			main.changesString += "</surfing>";
			main.changesString += "<selection>";
			main.xmlString += "<multi>";
			for (var i:int = 0; i < pics.length; i++)
			{
				
				main.xmlString += "<" + pics[i].xmlData + ">";
				
				main.xmlString += pics[i].isselected + "";
				main.xmlString += "</" + pics[i].xmlData + ">";
			}
			
			main.xmlString += "</multi>";
			main.xmlString += "</surfing>";
			main.xmlString += "<selection>";
			trace(main.changesString);
		}
		
		public function displayNext():void
		{
			main.stage.removeEventListener(MouseEvent.MOUSE_MOVE, move);
			main.displayNext();
		}
	}

}