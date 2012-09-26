package
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.net.URLRequest;
	import flash.ui.Keyboard;
	import flash.ui.Mouse;
	import flash.utils.getTimer;
	import flash.utils.Timer;
	
	public class TextScreen
	{
		public var main:Main;
		public var text:Label;
		public var timer:int;
		public var index:int;
		
		public var textString:String;
		public var stage:int = 0;
		public var tWidth:int = 1000;
		public var sprite:Sprite = new Sprite();
		
		public var hint:Label = null;
		private var background:Loader;
		private var elapsedTime:Number;
		private var hasDisplayedHint:Boolean;
		
		public function TextScreen(p_main:Main, p_textString:String)
		{
			main = p_main;
			textString = p_textString;
		}
		
		public function render():void
		{
			text = new Label(main, 0, 0, "");
			timer = 0;
			stage = 0;
			elapsedTime = 0;
			text.updateY = false;
			text.text.y = 200;
			hasDisplayedHint = false;
		
			//background = new Loader();
			//background.load(new URLRequest("assets/Beaches/Beach4.jpg"));
			//main.addChild(background);
			//main.setChildIndex(background, 0);
		
			//sprite.graphics.beginFill(0xFFFFFF,0.7);
			//sprite.graphics.drawRect(248, 148, 1104, 504);	
		/*
		   sprite.graphics.beginFill(0xFFFFFF,0.6);
		   sprite.graphics.drawRect(246, 146, 1108, 508);
		   sprite.graphics.beginFill(0xFFFFFF,0.5);
		   sprite.graphics.drawRect(244, 144, 1112, 512);
		   sprite.graphics.beginFill(0xFFFFFF,0.4);
		   sprite.graphics.drawRect(242, 142, 1116, 516);
		   sprite.graphics.beginFill(0xFFFFFF,0.3);
		   sprite.graphics.drawRect(240, 140, 1120, 520);6
		   sprite.graphics.beginFill(0xFFFFFF,0.2);
		   sprite.graphics.drawRect(238, 138, 1124, 524);
		   sprite.graphics.beginFill(0xFFFFFF, 0.1);
		   sprite.graphics.drawRect(236, 136, 1128, 528);
		   sprite.graphics.endFill();
		 */
			 //main.addChild(sprite);
			 //main.setChildIndex(sprite, 1);
		}
		
		public function update():void
		{
			//main.stage.addEventListener(MouseEvent.CLICK, keyPressed);
			timer++;
			index = timer / 3
			//trace("Timer: " + timer + " Index: " + index);
			//stage = 1;
			if (index <= textString.length)
			{
				text.changeText(800, 300, 35, textString.substr(0, index), tWidth, false);
				elapsedTime = getTimer();
			}
			else
			{
				stage = 1;
				//timer = textString.length * 3;
				text.changeText(800, 300, 35, textString, tWidth, false);
				if (getTimer() - elapsedTime > 100)
				{
					if (!hasDisplayedHint)
					{
						hasDisplayedHint = true;
						hint = new Label(main, 800, 600, "(Click to continue)", 35, 600, true);
						hint.text.alpha = 0;
					}
					else
					{
						main.stage.addEventListener(MouseEvent.CLICK, keyPressed);
						if (hint.text.alpha < 1)
						{
							hint.text.alpha += 0.01;
						}
					}
				}
			}
		}
		
		public function keyPressed(e:Event = null):void
		{
			stage++;
			if (stage == 2)
			{
				displayNext();
			}
		}
		
		public function writeXML():void
		{
			//main.xmlString += "</result>";
			//var xmlData:XML = new XML(main.xmlString);
			// trace (xmlData);
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
	}

}